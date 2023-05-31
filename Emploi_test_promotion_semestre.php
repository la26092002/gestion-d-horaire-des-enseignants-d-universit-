<?php

if (isset($_GET['promotion']) && !empty($_GET['promotion'])) {
    include('conn.php');

    echo '<option value=""></option><option value="1">S1</option>
                                        <option value="2">S2</option>';
} else {
    echo '<h1>error</h1>';
}
