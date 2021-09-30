<?php 
    include 'headers.php';
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);
?>

<section id="main" class="container-fluid">
    
    <?php include 'navbar.php' ?>

    <div class="row box-content">
        <div class="col-md-12 content content-box">
            <?php include "navbar-mini.php"?>

            <div class="alert" id="alert" style="padding: 10px 0; margin: 10px 0;">

            </div>

            <div class="row box-data">
                <div class="col-md-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td>Title</td>
                                <td>Excerpt</td>
                                <td>Description</td>
                                <td>Actions</td>    
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;
                                while($data = $result->fetch_assoc()) {
                                    echo '
                                        <tr>
                                            <td>'. ( $i + 1 ) .'</td>
                                            <td>'. $data["title"] .'</td>
                                            <td>'. $data["excerpt"] .'</td>
                                            <td>'. $data["description"] .'</td>
                                            <td>
                                                <a href="edit.php?id='. $data["id"] .'">Edit</a>
                                                <span> | </span>
                                                <a href="delete.php?id='. $data["id"] .'">delete</a>
                                            </td>
                                        </tr>
                                    '; 

                                    $i++;     
                                }
                            
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());

    if ( !params.text ) {
        console.log(null)
    } else {
        if (params.text.includes('success') == true ) {
            document.querySelector('#alert').innerHTML = `
                <div 
                    class="alert-wrapper" 
                    style="background-color: green; padding: 10px 25px; border-radius: 5px; color: #fff;"
                >
                    <span>${  params.text }</span>
                </div>
            `
        } else {
            document.querySelector('#alert').innerHTML = `
                <div 
                    class="alert-wrapper" 
                    style="background-color: red; padding: 10px 25px; border-radius: 5px; color: #fff;"
                >
                    <span>${  params.text }</span>
                </div>
            `
        }
    }
</script>

<?php include 'footers.php'?>