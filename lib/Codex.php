<?php

namespace application\lib;
class Codex {
    public $html = [];
    public $data;
    public $class = [];

    public function __construct($data, $class = []){
        $this->data = $data;
        $this->class = $class;
        foreach($data as $key => $value){
            if($key == 0 && $value['type'] == 'header'){
                continue;
            }
            switch($value['type']){
                case 'paragraph':
                    $this->paragraph($value);
                    break;
                case 'image':
                    $this->image($value);
                    break;

                case 'raw':
                    $this->raw($value);
                    break;
                case 'embed':
                    $this->embed($value);
                    break;

                case 'header':
                    $this->header($value);
                    break;
                case 'delimiter':
                    $this->delimiter($value);
                    break;
                case 'list':
                    $this->list($value);
                    break;
                case 'quote':
                    $this->quote($value);
                    break;
                default:
                    break;
            }
        }
    }

    public function paragraph($data){
        $template = "<p>" . $data['data']['text'] . "</p>";
        $this->html[] = $template;
    }

    public function delimiter($value){
        $this->html[] = "<div class='delimiter'></div>";
    }

    public function quote($value){
        $tag = <<<BLOCK
        <blockquote class="blockquote">
            <p>{$value['data']['text']}</p>
            <cite class="{$value['data']['alignment']}">{$value['data']['caption']}</cite>
        </blockquote>
BLOCK;

        $this->html[] = $tag;

        return $tag;
    }

    public function image($data){
        $url = $data['data']['file']['url'];
        $caption = $data['data']['caption'];
        $template = "<img src=\"$url\" title=\"$caption\" alt=\"$caption\" class=\"responsive-img\" data-action=\"zoom\"/>";
        $template .= "<p style='display:block; font-size:85%; text-align:center;' class='caption' >" . $caption . "</p>";
        $this->html[] = $template;

        return $data['data']['file']['url'];
    }

    public function header($data){
        $level = $data['data']['level'];
        $template = "<h$level>" . $data['data']['text'] . "</h$level>";
        $this->html[] = $template;
    }

    public function raw($data){
        $this->html[] = $data['data']['html'];

        return $data['data']['html'];
    }

    public function list($data){

        if($data['data']['style'] == 'ordered'){
            $html = "<ol>";
        } else {
            $html = "<ul>";
        }
        //        var_dump(htmlspecialchars($html));die;
        //$data['data']['style'] == 'ordered ' ? "<ol>" : "<ul>";
        foreach($data['data']['items'] as $item){
            $html .= "<li> $item </li>";
        }
        $tag = $data['data']['style'] == 'ordered '? '</ol>': "</ul>";
        $html .= $tag;
        $this->html[] = $html;
    }

    public function embed($data){
        //echo debug($data);
    }

    public function render(){
        $html = "";
        foreach($this->html as $key => $value){
            $html .= $value;
        }
        return $html;
    }

    public function returnHtml(){
        return $this->html;
    }

    public static function generateDesc($data){
        $attaches = [];
        foreach($data->blocks as $item){
            if(sizeof($attaches) >= 3 ){
                break;
            }
            if($item->type == 'image'){
                $attaches[] = "<img src=\"{$item->data->file->url}\" />";
            }

            if($item->type == 'quote'){
                $tag = <<<BLOCK
                    <blockquote class="blockquote">
                        <span>{$item->data->text}</span>
                        <cite class="{$item->data->alignment}">{$item->data->caption}</cite>
                    </blockquote>
BLOCK;
                $attaches[] = $tag;
            }
        }

        return $attaches;

    }

}
