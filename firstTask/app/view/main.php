<section class="main-section">
    <div class="flex abs-c">
        <h1>MAIN</h1>
    </div>   
    <div class="main-content-wrapper flex jst-btw">
        <div class="category-wrapper flex dr-col al-it-c">
            <div class="">
                <h2>Categories:</h2>
            </div>
            <div class="">
                <?php 
                    if ($data['categories']) {
                        echo '<ul>';
                        echo '<li name="all">All (' . $data['total_amount'] . ')</li>';
                        foreach($data['categories'] as $row) {
                            echo "<li name=$row[name]>" . ucfirst($row['name']) . ' (' . $row['amount'] . ')'. '</li>'; 
                        }
                        echo '</ul>';
                    }
                ?>  
            </div>       
             
        </div>
        <div class="product-wrapper flex dr-col">
            <div class="prod-sort-wrapper flex abs-c">
                <div class="prod-sort flex jst-btw">
                    <i>Sort by:</i>
                    <select name="" id="">
                        <option value="name_asc">A-Z</option>
                        <option value="new_asc">Newest</option>
                        <option value="price_asc">Low price</option>
                    </select>
                </div>   
            </div>
            <div class="prod flex dr-col">
                <div class="prod-items flex dr-col">
                <?php 
                    if ($data['products']) {     
                        foreach ($data['products'] as $product) {
                            echo '<div class="prod-item flex jst-btw al-it-c">';                   
                            echo '<div class="prod-item-name flex">' . $product['name'] . '</div>';
                            echo '<div class="prod-item-price">' . $product['price'] . ' USD</div>';
                            echo '<div class="btr-wrapper flex jst-c"><button class="btn-buy" data-toggle="modal" data-target="#modal" data_id="' . $product['id'] . '" name="buy">Купить</button></div>';
                            echo '</div>';
                        }
                    }
                ?>   
                </div>
            </div>
        </div>
    </div>  
</section>
