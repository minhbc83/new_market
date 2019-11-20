<?php 
    $parentscat = new ParentsCat($db);
    $stmt = $parentscat->read();
    $category = new Category($db);
    $manufacturer = new Manufacturer($db);
    $man_stmt = $manufacturer->read();
?>
<div class="mt-2 wrapper">
    <!-- Sidebar -->
    <nav class="rounded bg-success" id="sidebar">
        <ul class="list-unstyled components">
            <h5 class="rounded p-2 text-light">Danh mục sản phẩm</h5>
            <?php
            foreach ($stmt as $item) {
                $category->parentscat_id = $item['id'];
                echo '<li>';
                    echo '<a href="#parentscat'.$item['id'].'" data-toggle="collapse" aria-expanded="false" class="text-light dropdown-toggle">'.$item['name'].'</a>';
                    echo '<ul class="collapse list-unstyled" id="parentscat'.$item['id'].'">';
                    $cat_stmt = $category->readParentscat_id();
                    foreach ($cat_stmt as $cat_item) {
                        echo '<li>';
                            echo '<a class="text-light" href="category.php?cat_id='.$cat_item['id'].'">'.$cat_item['name'].'</a>';
                        echo '</li>';
                    }
                    echo '</ul>';
                echo '</li>';
            }
            echo '<hr>';
            ?>
            <h5 class="rounded p-2 text-light">Nhà sản xuất</h5>
            <?php
            foreach ($man_stmt as $man_item){
                echo '<li>';
                    echo '<a class="text-light" href="#">'.$man_item['name'].'</a>';
                echo '</li>';
            }
            ?>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </nav>