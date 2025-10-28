<?php
function component($prod_name, $prod_img, $prod_price, $prod_info, $prod_id)
{
    $element = "
                <div class=\"col-md-3 col-sm-6 my-3 my-md-0 drac\">
                    <form action=\"\" method=\"POST\" style=\"margin-left: 50px;\">
                        <div class=\"card shadow\">
                            <div>
                                <img src=\"$prod_img\" alt=\"image\" class=\"img-fluid card-img-top\">
                            </div>
                            <div class=\"card-body\">
                                <h5 class=\"card-title\">$prod_name</h5>

                                <h5>
                                    <span class=\"price\">₱ $prod_price</span>
                                </h5>
                                <div class=\"det\" style=\"display: flex; gap: 16px;\">
                                    <button class=\"btn my-3 \" id=\"btnmore\">
                                        <details>
                                            <summary>More info</summary>
                                            <p>$prod_info</p>
                                        </details>
                                    </button>

                                    <button type=\"submit\" id=\"btnadd\" name=\"add\" class=\"btn  my-3\">Add to cart</button>
                                    <input type=\"hidden\" name=\"product_id\" value=\"$prod_id\">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
    ";
    echo ($element);
}

function component_warning($prod_name, $prod_img, $prod_price, $prod_info, $prod_id,$prod_quantity)
{
    $element = "
                <div class=\"col-md-3 col-sm-6 my-3 my-md-0 drac\">
                    <form action=\"\" method=\"POST\" style=\"margin-left: 50px;\">
                        <div class=\"card shadow\">
                            <div>
                                <img src=\"$prod_img\" alt=\"image\" class=\"img-fluid card-img-top\">
                            </div>
                            <div class=\"card-body\">
                                <h5 class=\"card-title\">$prod_name</h5>

                                <h5>
                                    <span class=\"price\">₱ $prod_price</span>
                                </h5>
                                <h6 style=\"display:flex; position:absolute; margin-top:-7px; margin-left:50px; color:red;\" >Only $prod_quantity items left</h6>
                                <div class=\"det\" style=\"display: flex; gap: 16px;\">
                                    <button class=\"btn my-3 \" id=\"btnmore\">
                                        <details>
                                            <summary>More info</summary>
                                            <p>$prod_info</p>
                                        </details>
                                    </button>
                                    
                                    <button type=\"submit\" id=\"btnadd\" name=\"add\" class=\"btn  my-3\">Add to cart</button>
                                    <input type=\"hidden\" name=\"product_id\" value=\"$prod_id\">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
    ";
    echo ($element);
}

function component_empty($prod_name, $prod_img, $prod_price, $prod_info, $prod_id)
{
    $element = "
                <div class=\"col-md-3 col-sm-6 my-3 my-md-0 drac\">
                    <form action=\"\" method=\"POST\" style=\"margin-left: 50px;\">
                        <div class=\"card shadow\">
                            <div>
                                <img src=\"$prod_img\" alt=\"image $prod_info\" class=\"img-fluid card-img-top\">
                            </div>
                            <div class=\"card-body\">
                                <h5 class=\"card-title\">$prod_name</h5>

                                <h5>
                                    <span class=\"price\">₱ $prod_price</span>
                                </h5>
                                <div class=\"det\" style=\"display: block;\">
                                    <h2 class=\"oos\">
                                     Out of stock
                                    </h2>
                                    <br>
                                    <input type=\"hidden\" name=\"product_id\" value=\"$prod_id\">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
    ";
    echo ($element);
}



function cartElement($prod_name, $prod_img, $prod_price, $prod_id){
    
    $element = "
    
    <form action=\"\" method=\"POST\" class=\"cart-items\">
                        <div class=\"border rounded\">
                            <div class=\"row bg-white\">
                                <div class=\"col-md-3\" style=\"padding-left: 0;\">
                                    <img src=\"$prod_img\" alt=\"\" class=\"img-fluid\">
                                </div>
                                <div class=\"col-md-6\">
                                    <h5 class=\"pt-2\">$prod_name</h5>
                                    <br>
                                    <h5 class=\"pt-2\">₱ $prod_price</h5>
                                    <input type=\"hidden\" id=\"delid\" name=\"product_id\" value=\"$prod_id\">
                                    <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                                </div>
                            </div>
                        </div>
                    </form>

    ";
    echo $element;
}
$total = 0;