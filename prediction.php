<?php
/**
 * Created by PhpStorm.
 * User: karti
 * Date: 06-Nov-17
 * Time: 8:57 PM
 */
include "dbconfig.php";
if (isset($_POST['key'])){
    $key = $_POST['key'];
    $res = $mysqli->query("SELECT * FROM menu WHERE Name LIKE '%$key%'");
    $html = '';
    while ($row = $res->fetch_assoc()){
        $type = explode(' ',$row['category']);
        if ($type[0] == "Veg")
            $sym = "images/indian-vegetarian-mark-90.png";
        else
            $sym = "images/non-veg-symbol.png";
        $html .= <<<EOT
            <div class="col-md-2"></div>
            <div class="col-md-4 col-xs-12 card">
                <div class="row">
                <img src="{$row['img_src']}" class="img-responsive menu-img"/>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-9">
                        <h2 class="itemHeading">{$row['Name']} <img src="{$sym}" style="width: 20px;height: 20px"/></h2>
                        <p class="itemDes">{$row['description']}</p>
                        <h4 class="pricing">{$row['cost']}&#x20b9;</h4><br>
                        </div>
                        <div class="col-md-6 col-xs-3">
                        <div class="btn-group" value="{$row['item_id']}">
                        <button class="btn btn-quantity"><i class="material-icons">remove_circle_outline</i></button>
                        <button class="btn btn-quantity"><span id="quantity">&nbsp; 0</span></button>
                        <button class="btn btn-quantity"><i class="material-icons">add_circle_outline</i></button>
                        
                        </div>                
                    </div>
                </div>
            </div>
EOT;
    }
    echo $html;
}