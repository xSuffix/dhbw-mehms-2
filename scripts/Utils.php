<?php

class Utils
{
    public static function extractUser($input) : Array {
        $words = explode(' ', $input);
        $user = "";
        switch (count($words)) {
            case 0:
                return ["user" => '',"search" => ''];
            case 1:
                if (substr($words[0],0,2) == "u/") {
                    return ["user" => substr($words[0],2),"search" => ''];
                } else {
                    return ["user" => '',"search" => $words[0]];
                }
        }
        if (substr($words[0],0,2) == "u/") {
            $user = substr($words[0],2);
        }
        return ["user" => $user,"search" => $words[1]];
    }

    // Gets the Mehms, transforms them into cards and shows them. Possibility to add additional features to the cards (like for the admin)
    public static function getMehmCards($db, $filter, $sort, $desc, $admin, $myMehms)
    {
        $images = $db->getMehms($filter, $sort, $desc, $admin);

        if ($myMehms) {
            $count = count($images);
            for ($i = 0; $i < $count; $i++)  {
                if ($images[$i]['UserID'] != $_SESSION['id']) {
                    unset($images[$i]);

                }
            }
        }
        $dirname = "./assets/mehms/";

        foreach ($images as $image) {
            $imageID = $image["ID"];
            $imageName = $image["Path"];
            $imageFile = $dirname . $imageName;
            if ($imageFile != "./assets/mehms/rick.gif") {
                $sizes = getimagesize($imageFile);
                try {
                    if ($admin) {
                        $infix = Utils::adminInfix($image["ID"]);
                        $href = "";
                    } else {
                        $infix = "";
                        $href = 'href="./mehm?id=' . $imageID . '" ';
                    }

                    echo '<a class="mehm-card" ' . $href . 'style="width:' . $sizes[0] * 300 / $sizes[1] .
                        'px; flex-grow: ' . $sizes[0] * 300 / $sizes[1] . '"><div style="padding-top: ' .
                        $sizes[1] / $sizes[0] * 100 . '%"></div><img src="' . $imageFile . '" loading="lazy" name="' . $imageName . '" alt="' . $imageName . '" />' . $infix . '</a>';
                } catch (DivisionByZeroError $e) {
                    echo '<script>console.log("Invalid Picture");</script>';
                }
            }
        }
    }

    public static function adminInfix($index): string
    {
        return '<div class="admin-overlay">' .
            '<div><div class="box button" id="a' . $index . '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></div> Approve </div>' .
            '<div><div class="box button" id="d' . $index . '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" /></svg></div> Decline </div>' .
            '</div>';
    }

}
