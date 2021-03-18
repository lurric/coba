                    <style>
                    table {
                      border-collapse: collapse;
                      border-spacing: 0;
                      width: 100%;
                    }

                    th, td {
                      text-align: left;
                      padding: 8px;
                    }

                    tr {
                      border-bottom: 1px solid #000;
                    }
                    .card-body:before {
                        left: 22px !important;
                    }
                    .post {
                        font-weight: 700;
                        margin-right: 20px;
                        float: left;
                    }
                    #open {
                        display: none;
                    }
                    @media screen and (max-width: 768px) {
                        .post {
                            font-weight: 700;                            
                            font-size: 20px;
                        }
                        .date {
                            display: none;                            
                        }
                        #link {
                            display: none;
                        }
                        #open {
                            display: block;
                        }
                        .edit {
                             margin-bottom: 5px;
                        }
                    }
                </style>
                <?php
                // notif status
                include 'notif.php';
                ?>
                <?php
                $post = array_filter(explode("\n", file_get_contents("../data/post.txt")));
                $n = 0;
                foreach ($post as $listpost) { 
                    $datapost = array_filter(explode("\n", file_get_contents("../data/post/".$listpost."/data.txt")));
                    $image_url = file_get_contents("../data/post/".$listpost."/urlimg.txt");
                    $n++;
                ?>
                <!-- Modal edit content -->
                <div id="myModaledit<?php echo $n; ?>" class="modal">
                    <div class="modal-content">
                        <span id="closeedit<?php echo $n; ?>" class="close">&times;</span>
                        <h4><strong>Edit Post</strong></h4>            
                    </div>
                    <div class="modal-content">
                        <form method="POST" action='' enctype="multipart/form-data">
                        <div class="form-row" style="padding: 0; border: none;">
                            <div class="name">Title<br><em style="font-weight: normal;">Post</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <input type="text" class="input--style-6" name="title" placeholder="Title" value="<?php echo $datapost[0]; ?>">
                                </div>
                            </div>
                            <div class="name">URL<br><em style="font-weight: normal;">Image</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="imgurl" placeholder='URL 1&#10;URL 2&#10;URL 3'><?php echo $image_url; ?></textarea><em>diisi sesuai format diatas.</em>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <input type="hidden" name="editpost" value="<?php echo $listpost; ?>">
                            <input type="hidden" name="menu" value="Post">
                            <button id="loadedit<?php echo $n; ?>" style="margin: 5px; background-color: #F14E95; padding: 0 10px; line-height: 30px; font-size: 12px; text-decoration: none;" class="btn btn--radius-2 btn--blue-2" type="submit" name="savepost">Save</button>
                            <button id="canceledit<?php echo $n; ?>" style="margin: 5px; background-color: #ccc; color: #000; padding: 0 10px; line-height: 30px; font-size: 12px; text-decoration: none;" class="btn btn--radius-2 btn--blue-2" type="reset">Batal</button>
						    <!-- Loading-->
						    <script type="text/javascript">                        
						        document.getElementById("loadedit<?php echo $n; ?>").addEventListener("click", myFunctions);
						        function myFunctions() {
						          document.getElementById("loadedit<?php echo $n; ?>").innerHTML = '<i class="fa fa-circle-o-notch fa-spin"></i> Tunggu bentar...';
						        }
						    </script>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- Modal delete content -->
                <div id="myModal<?php echo $n; ?>" class="modal">
                    <div class="modal-content">
                        <span id="close<?php echo $n; ?>" class="close">&times;</span>
                        <h4><strong>Attention!</strong></h4>            
                    </div>
                    <div class="modal-content">
                        <form method="POST" action='' enctype="multipart/form-data">
                        <p style="margin-bottom: 20px;">Yakin ingin menghapus post <strong><?php echo $datapost[0]; ?></strong> ?</p>
                        <div style="text-align: right;">
                            <input type="hidden" name="deletepost" value="<?php echo $listpost; ?>">
                            <input type="hidden" name="menu" value="Post">
                            <button id="load<?php echo $n; ?>" style="margin: 5px; background-color: #ff0000; padding: 0 10px; line-height: 30px; font-size: 12px; text-decoration: none;" class="btn btn--radius-2 btn--blue-2" type="submit" name="savepost">Yakinlah suer!</button>
                            <button id="cancel<?php echo $n; ?>" style="margin: 5px; background-color: #ccc; color: #000; padding: 0 10px; line-height: 30px; font-size: 12px; text-decoration: none;" class="btn btn--radius-2 btn--blue-2" type="reset">Batal</button>
						    <!-- Loading-->
						    <script type="text/javascript">                        
						        document.getElementById("load<?php echo $n; ?>").addEventListener("click", myFunctions);
						        function myFunctions() {
						          document.getElementById("load<?php echo $n; ?>").innerHTML = '<i class="fa fa-circle-o-notch fa-spin"></i> Tunggu bentar...';
						        }
						    </script>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- end Modal content -->
                <?php 
                if(!isset($_POST['allpost'])) {
                if ($n == 5) {
                    break;
                } } }
                ?>
                <div class="card-body" style="margin-top: 50px;">
                    <form method="post" onsubmit="return false">
                        <div class="form-row">
                            <h3 style="font-weight: 700;">Add Post</h3>
                        </div>
                        <div class="form-row" style="border: none;">
                            <div class="name">Title<br><em style="font-weight: normal;">Add New</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea id="keyword" class="textarea--style-6" name="title" placeholder='Title 1&#10;Title 2&#10;Title 3'></textarea><em>diisi sesuai format diatas.</em>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align: right; padding-top: 0;">
                        <button id="posting" style="background-color: #F14E95;" class="btn btn--radius-2 btn--blue-2" type="submit" name="savepost">Posting</button>
                    </form>
                        <div class="result" style="display: none;">
                            <center style="margin: 20px 0;">
                                <div id="done" style="display: none;">
                                    <h4 style="font-weight: 700; margin: 10px;">Selesai Posting!</h4>
                                    <form action="" method="post" enctype="multipart">
                                        <input type="hidden" name="refresh" value="Post">
                                        <input type="hidden" name="menu" value="Post">
                                        <button type="submit" name="savepost"><a>Refresh</a></button>
                                        untuk melihat post baru.
                                    </form>
                                </div>
                                <span>Result :</span>
                                <span id="count"></span>
                                <div style="height: 80px; margin: 20px 0;">
                                <textarea id="success" style="width: 45%; height: 120px; padding: 10px 20px; margin-left: 5px; border: 1px solid #cccccc; border-radius: 3px;" readonly>Success :</textarea>
                                <textarea id="error" style="width: 45%; height: 120px; padding: 10px 20px; margin-left: 5px; border: 1px solid #cccccc; border-radius: 3px;" readonly>Error :</textarea>
                                </div>
                            </center>
                        </div>
                    </div>
                <script type="text/javascript">                            
                    $(document).ready(function(){
                        $("#posting").click(function(){
                            var isValid = true;
                            var keywords = $('#keyword').val().split("\n");
                            var count = keywords.length;
                            var n = 0;
                            var ok = 0;
                            var no = 0;
                            if (keywords[0].trim() != '') {
                                $("#posting").html('<i class="fa fa-circle-o-notch fa-spin"></i> Processing...');
                                (function addPost() {
                                    var data = {
                                        kw : keywords[n]
                                    };
                                    $.ajax({
                                        type: 'POST',
                                        url: "posting.php",
                                        data: data,
                                        success: function(result) {
                                            $('.result').attr("style","display:block");
                                            n++;
                                            var postresult = result; 
                                            if(postresult == 'google') {
                                                no++;
                                                $('#count').html(n+' keyword ('+ok+' success | '+no+' error)');
                                                $('#success').append("\n[can't access google] "+data.kw+"<hr>");
                                            } 
                                            if(postresult == 'ok') {
                                                ok++;
                                                $('#count').html(n+' keyword ('+ok+' success | '+no+' error)');
                                                $('#success').append('\n[done] '+data.kw+'<hr>');
                                            } 
                                            if(postresult == 'no') {
                                                no++;
                                                $('#count').html(n+' keyword ('+ok+' success | '+no+' error)');
                                                $('#error').append('\n[failed] '+data.kw+'<hr>');
                                            } 
                                            if(postresult == 'bad') {
                                                no++;
                                                $('#count').html(n+' keyword ('+ok+' success | '+no+' error)');
                                                $('#error').append('\n[badword] '+data.kw+'<hr>');
                                            } 
                                            if(postresult == 'duplicate') {
                                                no++;
                                                $('#count').html(n+' keyword ('+ok+' success | '+no+' error)');
                                                $('#error').append('\n[duplicate] '+data.kw+'<hr>');
                                            }
                                            if(n == count) { 
                                                $('#done').attr("style","display:block");
                                                $('#posting').html('Posting');
                                                $('#keyword').val('');
                                             } else setTimeout(addPost, 1000);
                                        },
                                        error: function() {
                                            n++;
                                            no++;
                                            $('.result').attr("style","display:block");
                                            $('#count').html(n+' keyword ('+ok+' success | '+no+' error)');
                                            $('#error').append('\n[timeout] '+data.kw+'<hr>');
                                            if(n == count) {
                                                $('#done').attr("style","display:block");
                                                $('#posting').html('Posting');
                                                $('#keyword').val('');
                                            } else addPost();
                                        }
                                    });
                                }());       
                            }
                        }); 
                    }); 
                </script>
                <?php if ($post) { ?>
                <div class="card">
                    <div class="form-row" style="border: none;">
                        <h3 class="post">Post (<?php echo count($post); ?>)</h3>
                        <a href="<?php echo $url; ?>/data/post.csv"><button style="background-color: #00b300; padding: 0 10px; line-height: 40px; font-size: 14px;" class="btn btn--radius-2 btn--blue-2">Export CSV</button></a>
                    </div>
                </div>
                <div class="card-footer" style="padding-top: 5px;"> 
                    <div class="table">
                        <table class="table table-hover" <?php if(isset($_POST['allpost'])) { echo 'id="dataTables-example"'; } ?> >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th class="date">Date</th>
                                    <th>URL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $n = 0;
                            foreach ($post as $listpost) { 
                                $datapost = array_filter(explode("\n", file_get_contents("../data/post/".$listpost."/data.txt")));
                                $n++;
                                $b = "button".$n;
                                $c = "copy".$n;
                                // edit
                                $ss = "myBtnedit".$n;
                                $zz = "myModaledit".$n;
                                $xx = "closeedit".$n;
                                $rr = "canceledit".$n;
                                // delete
                                $s = "myBtn".$n;
                                $z = "myModal".$n;
                                $x = "close".$n;
                                $r = "cancel".$n;
                            ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $n; ?></td>
                                    <td>
                                        <strong><?php echo $datapost[0]; ?></strong>
                                        <br>
                                        <small><a id="link" style="text-decoration: none;" href="<?php echo $url."/".$listpost; ?>.html" target="_blank"><?php echo $url."/".$listpost; ?>.html&nbsp;&nbsp;</a></small>
                                    </td>
                                    <td class="date">
                                        <?php echo $datapost[1]." <small>".$datapost[2]."</small>"; ?>
                                        <input type="text" style="width: 0.1px;" id="<?php echo $c; ?>" name="link" value="<?php echo $url."/".$listpost; ?>.html">
                                    </td>
                                    <td><a id="open" style="text-decoration: none;" href="<?php echo $url."/".$listpost; ?>.html" target="_blank"><button style="background-color: #00b300; padding: 0 10px; line-height: 30px; font-size: 12px; text-decoration: none; margin-bottom: 5px;" class="btn btn--radius-2 btn--blue-2" type="button">Buka</button></a>
                                        <button id="<?php echo $b; ?>" style="padding: 0 10px; line-height: 30px; font-size: 12px; text-decoration: none;" class="btn btn--radius-2 btn--blue-2" type="button" name="tamu">Salin</button>
                                        <script type="text/javascript">
                                            document.getElementById("<?php echo $b; ?>").addEventListener("click", function() {
                                            document.getElementById("<?php echo $b; ?>").innerHTML = "Disalin!";
                                            copyToClipboard(document.getElementById("<?php echo $c; ?>"));

                                        });
                                        </script>
                                    </td>
                                    <td class="center">    
                                        <input type="hidden" name="datapost<?php echo $n; ?>" value="<?php echo $listpost; ?>">
                                        <button id="myBtnedit<?php echo $n; ?>" style="background-color: #F14E95; padding: 0 10px; line-height: 30px; font-size: 12px; text-decoration: none;" class="btn btn--radius-2 btn--blue-2 edit" type="button">Edit</button>
                                        <script type="text/javascript">                                            
                                            document.getElementById("<?php echo $ss; ?>").onclick = function() {
                                                document.getElementById("<?php echo $zz; ?>").style.display = "block";
                                            }
                                            document.getElementById("<?php echo $xx; ?>").onclick = function() {
                                                document.getElementById("<?php echo $zz; ?>").style.display = "none";
                                            }
                                            document.getElementById("<?php echo $rr; ?>").onclick = function() {
                                                document.getElementById("<?php echo $zz; ?>").style.display = "none";
                                            }
                                            window.onclick = function(event) {
                                                if (event.target == document.getElementById("<?php echo $zz; ?>")) {
                                                    document.getElementById("<?php echo $zz; ?>").style.display = "none";
                                                }
                                            }
                                        </script>
                                        <button id="myBtn<?php echo $n; ?>" style="background-color: #ff0000; padding: 0 10px; line-height: 30px; font-size: 12px; text-decoration: none;" class="btn btn--radius-2 btn--blue-2" type="button">Hapus</button>
                                        <script type="text/javascript">
                                            document.getElementById("<?php echo $s; ?>").onclick = function() {
                                                document.getElementById("<?php echo $z; ?>").style.display = "block";
                                            }
                                            document.getElementById("<?php echo $x; ?>").onclick = function() {
                                                document.getElementById("<?php echo $z; ?>").style.display = "none";
                                            }
                                            document.getElementById("<?php echo $r; ?>").onclick = function() {
                                                document.getElementById("<?php echo $z; ?>").style.display = "none";
                                            }
                                            window.onclick = function(event) {
                                                if (event.target == document.getElementById("<?php echo $z; ?>")) {
                                                    document.getElementById("<?php echo $z; ?>").style.display = "none";
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                            <?php
                            if(!isset($_POST['allpost'])) {
                            if ($n == 5) {
                                break;
                            } } }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if (!isset($_POST['allpost'])) { ?>
                    <br>
                    <form method="POST" action='' enctype="multipart/form-data">
                    <center><button style="padding: 0 10px; line-height: 40px; font-size: 14px;" class="btn btn--radius-2 btn--blue-2" type="submit" name="allpost">Show All Post</button></center>
                    </form>
                    <?php } ?> 
                </div>
                <?php } ?>