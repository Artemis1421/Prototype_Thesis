<?php  
    function get_pagination_links($current_page, $total_pages, $url)
    {
        $links = "";
        if ($total_pages >= 1 && $current_page <= $total_pages) {
            $links .= "<a class='w-6 font-semibold text-center text-gray-200 bg-gray-600 border-r' href=\"{$url}?page=1\">1</a>";
            $i = max(2, $current_page - 2);
            
            $links .= "<div class='w-6 font-semibold text-center text-gray-200 bg-gray-600 border-r' >...</div>";
            for (; $i < min($current_page + 3, $total_pages); $i++) {
                $links .= "<a class='w-6 font-semibold text-center text-gray-200 bg-gray-600 border-r border-gray-300' href=\"{$url}?page={$i}\">{$i}</a>";
            }
            
            $links .= "<div class='w-6 font-semibold text-center text-gray-200 bg-gray-600 border-r' >...</div>";
            $links .= "<a class='w-6 font-semibold text-center text-gray-200 bg-gray-600' href=\"{$url}?page={$total_pages}\">{$total_pages}</a>";
        }
        return $links;
    }
?>