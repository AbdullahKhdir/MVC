        <h3 style="text-align: center">Welcome <?php echo $name ?> </h3>
        <div>
            <?php
            echo "<br>";
            ?>
            <div class="container-sm">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email"
                               class="form-control"
                               id="exampleFormControlInput1"
                               placeholder="name@example.com"
                               name="email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                        <textarea class="form-control"
                                  id="exampleFormControlTextarea1"
                                  rows="3"
                                  name="txtArea"></textarea>
                    </div>
                    <button class="btn btn-outline-primary"
                            type="submit"
                            style="margin-bottom: 20px">Submit</button>
                </form>
            </div>
        </div>
    </body>
</html>