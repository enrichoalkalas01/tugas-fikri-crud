<?php include 'headers.php'?>

<section id="main" class="container-fluid">
    
    <?php include 'navbar.php' ?>

    <div class="row box-content">
        <div class="col-md-12 content content-box">
            <?php include "navbar-mini.php"?>

            <div class="alert" id="alert" style="padding: 10px 0; margin: 10px 0;">

            </div>

            <div class="row form-box">
                <div class="col-md-12 text-center">
                    <h2>Form Input Data</h2>
                </div>
                <div class="col-md-12 form-content">
                    <form action="form-create.php" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder="...">
                        </div>
                        <div class="mb-3">
                            <label for="excerpt" class="form-label">Excerpt</label>
                            <input name="excerpt" type="text" class="form-control" id="excerpt" placeholder="...">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Example textarea</label>
                            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());
    console.log(params)
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