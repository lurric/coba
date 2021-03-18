                <?php
                $addpost = file_get_contents("../data/addnewpost.txt");

                // notif status
                include 'notif.php';
                ?>
                <style type="text/css">
                    .card-body:before {
                        left: 265px !important;
                    }
                </style>
                <div class="card-body" style="text-align: center; margin-top: 50px;">
                    <div class="form-row">
                        <h3 style="font-weight: 700;">Sitemap</h3>
                    </div>
                    <div class="card-footer" style="padding: 30px;">
                        <center>
                        <h4><strong>Generate Sitemap</strong></h4>
                        <br>
                        <a href="<?php echo $url.'/just-sitemap.xml'; ?>" target="_blank"><button style="background-color: #F14E95;" class="btn btn--radius-2 btn--blue-2" type="submit" name="saveother">Generate</button></a>
                        </center>
                    </div>
                </div>
                <div class="card">
                    <form method="POST" action='' enctype="multipart/form-data">
                        <div class="form-row">
                            <h3 style="font-weight: 700;">Add Post <small>(Background Script)</small></h3>
                        </div>
                        <div class="form-row">
                            <div class="name">Title<br><em style="font-weight: normal;">Add Post</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="title" placeholder='Title 1&#10;Title 2&#10;Title 3'><?php echo $addpost; ?></textarea><em>script file : [directory]/addpost.php</em>
                                </div>
                                <div style="text-align: right; margin-top: 10px;">
                                <input type="hidden" name="addpost" value="Other">
                                <input type="hidden" name="menu" value="Other">
                                <button id="load" style="background-color: #F14E95;" class="btn btn--radius-2 btn--blue-2" type="submit" name="saveother">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card" style="text-align: center;">
                    <form method="post" onsubmit="return false">
                        <div class="form-row">
                            <h3 style="font-weight: 700;">Export</h3>
                        </div>
                        <div class="card-footer" style="padding: 30px;">
                            <center>
                            <h4><strong>Export all content into HTML</strong></h4>
                            <em>script file : [directory]/export.php</em>
                            <br>
                            <em>location : [directory]/export/</em>
                            <br>
                            <br>
                            <?php 
                            $page = array($url);
                            $filename = array("index.html");
                            $posts = explode("\n", $get_post);
                            foreach ($posts as $listpost) {
                                $page[] = $url.'/'.$listpost.'.html';
                                $filename[] = $listpost.".html";
                            } 
                            $pages = array_diff(scandir("../data/page"), array('..', '.'));
                            foreach ($pages as $list_page) {
                                $page[] = $url.'/p/'.str_replace(".txt", "", $list_page).'.html';
                                $filename[] = str_replace(".txt", "", $list_page).".html";
                            }
                            ?>
                            <textarea id="page" style="width: 0.1px; height: 0.1px;"><?php echo implode("\n", $page); ?></textarea>
                            <textarea id="filename" style="width: 0.1px; height: 0.1px;"><?php echo implode("\n", $filename); ?></textarea>
                            <input type="hidden" name="menu" value="Other">
                            <button id="export" style="background-color: #F14E95;" class="btn btn--radius-2 btn--blue-2" type="submit" name="saveother">Generate</button>
                            </center>
                            <div class="result" style="display: none;">
                                <center style="margin: 20px 0;">
                                    <h4 id="done" style="font-weight: 700; margin: 10px;"></h4>
                                    <span>Result :</span>
                                    <span id="count"></span>
                                    <div style="height: 120px; margin: 20px 0;">
                                    <textarea id="success" style="width: 45%; height: 120px; padding: 10px 20px; margin-left: 5px; border: 1px solid #cccccc; border-radius: 3px;" readonly>Success :</textarea>
                                    <textarea id="error" style="width: 45%; height: 120px; padding: 10px 20px; margin-left: 5px; border: 1px solid #cccccc; border-radius: 3px;" readonly>Error :</textarea>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
                <script type="text/javascript">                            
                    $(document).ready(function(){
                        $("#export").click(function(){
                            var isValid = true;
                            var pages = $('#page').val().split("\n");
                            var filename = $('#filename').val().split("\n");
                            var count = pages.length;
                            var n = 0;
                            var ok = 0;
                            var no = 0;
                            if (pages[0].trim() != '') {
                                $("#export").html('<i class="fa fa-circle-o-notch fa-spin"></i> Processing...');
                                (function exportPage() {
                                    var data = {
                                        pg : pages[n],
                                        fn : filename[n]
                                    };
                                    $.ajax({
                                        type: 'POST',
                                        url: "export.php",
                                        data: data,
                                        success: function(result) {
                                            $('.result').attr("style","display:block");
                                            n++;
                                            var postresult = result; 
                                            if(postresult == 'ok') {
                                                ok++;
                                                $('#count').html(n+' page ('+ok+' success | '+no+' error)');
                                                $('#success').append('\n[done] '+data.pg+'<hr>');
                                            } 
                                            if(postresult == 'no') {
                                                no++;
                                                $('#count').html(n+' keyword ('+ok+' success | '+no+' error)');
                                                $('#error').append('\n[failed] '+data.pg+'<hr>');
                                            }
                                            if(n == count) { 
                                                $('#done').html('Selesai Export!');
                                                $('#export').html('Generate');
                                             } else setTimeout(exportPage, 500);
                                        },
                                        error: function() {
                                            n++;
                                            no++;
                                            $('.result').attr("style","display:block");
                                            $('#count').html(n+' keyword ('+ok+' success | '+no+' failed)');
                                            $('#error').append('\n[timeout] '+data.pg+'<hr>');
                                            if(n == count) {
                                                $('#done').html('Selesai Export!');
                                                $('#export').html('Generate');
                                            } else exportPage();
                                        }
                                    });
                                }());       
                            }
                        }); 
                    }); 
                </script>