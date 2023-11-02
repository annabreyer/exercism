<?php

function language_list()
{
    $array = [];

    $args = func_get_args();
    if (empty($args)){
        return $array;
    }

    foreach ($args as $arg){
        $array[] = $arg;
    }

    return $array;
}

function add_to_language_list(array $list, string $language)
{
    $list[] = $language;

    return $list;
}

function prune_language_list(array $list)
{
    unset($list[0]);

    return array_values($list);
}

function current_language(array $list)
{
    return $list[0];
}

function language_list_length(array $list)
{
    return count($list);
}
