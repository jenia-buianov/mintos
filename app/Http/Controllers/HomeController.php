<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $excludeWords = ['the','be','to','of','and','a','in','that','have','I','it','for','not','on','with','he','as','you','do','at','this','but','his','by','from','they','we','say','her','she','or','an','will','my','one','all','would','there','their','what','so','up','out','if','about','who','get','which','go','me'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('home.index',[
            'feed'=>$this->feed()
        ]);
    }

    public function words(){
        return response()->json(['words'=>$this->getWordsCount($this->feed(),['summary','title'])]);
    }

    private function getWordsCount(Collection $collection, $variables = []){
        $singleText = "";
        for($i=0;$i<count($variables);$i++){
            $singleText.=" ".mb_strtolower(strip_tags($collection->pluck($variables[$i])->implode(' ')));
        }
        $singleText = trim(str_replace("'s",'',str_replace([',','.',"\n",'','^','(',')','?','!','.',' - ','–','%','…',':','_'],' ',$singleText)));
        $words = collect(explode(' ',$singleText))->map(function ($value){
            return ['word'=>$value];
        })  ->whereNotIn('word',collect($this->excludeWords)
            ->map(function($value){return mb_strtolower($value);}));

        $count = [];

        foreach ($words->where('word','<>','')->values() as $i=>$value){
            $count[$value['word']] = isset($count[$value['word']])?$count[$value['word']]+1:1;
        }

        arsort($count);

        return collect($count)->map(function ($key,$value){
            return ['word'=>$value,'count'=>$key];
        })->sortByDesc('count')
            ->take(10)
            ->values();
    }

    private function feed(){
        $xml = simplexml_load_string(file_get_contents("https://www.theregister.co.uk/software/headlines.atom"));
        return collect(json_decode(json_encode($xml),TRUE)['entry']);
    }
}
