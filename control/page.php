                <?php 
                $dmca = file_get_contents("../data/page/dmca.txt");
                $contact = file_get_contents("../data/page/contact.txt");
                $privacy_policy = file_get_contents("../data/page/privacy-policy.txt");
                $copyright = file_get_contents("../data/page/copyright.txt");
                ?>
                <style type="text/css">
                    .card-body:before {
                        left: 92px !important;
                    }
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
                    #open {
                        display: none;
                        float: left;
                    }
                    @media screen and (max-width: 768px) {
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
                // page edit form
                if (isset($_POST['pageedit'])) {
                    $pages_title = strtoupper(str_replace(".txt", "", $_POST['pageedit']));
                    $datapage = file_get_contents("../data/page/".$_POST['pageedit']);
                ?>
                <form method="POST" action='' enctype="multipart/form-data">
                    <div class="card-body" style="margin-top: 50px;">
                        <div class="form-row">
                            <h3 style="font-weight: 700;">Edit Page</h3>
                        </div>
                        <div class="form-row" style="border: none;">
                            <div class="name"><?php echo $pages_title; ?></div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea id="editor" class="textarea--style-6" name="page" placeholder=''><?php echo $datapage; ?></textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align: right; padding-top: 0;">
                        <input type="hidden" name="editpage" value="<?php echo $_POST['pageedit']; ?>">
                        <input type="hidden" name="menu" value="Page">
                        <button id="load" style="background-color: #F14E95;" class="btn btn--radius-2 btn--blue-2" type="submit" name="savepage">Save</button>
                    </div>
                </form>
                <?php } else { ?>
                <div class="card-body" style="margin-top: 50px;">
                    <div class="form-row">
                        <h3 style="font-weight: 700;">Page</h3>
                    </div>
                </div>
                <div class="card-footer" style="padding-top: 25px;"> 
                    <div class="table">
                        <table class="table table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Page</th>
                                    <th>URL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $n = 0;
                            $list_page = array_diff(scandir("../data/page"), array('..', '.'));
                            foreach ($list_page as $pages) { 
                                $pages_title = str_replace("-", " ", strtoupper(str_replace(".txt", "", $pages)));
                                $datapage = file_get_contents("../data/page/".$pages);
                                $n++;
                                $b = "button".$n;
                                $c = "copy".$n;
                            ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $n; ?></td>
                                    <td>
                                        <strong><?php echo $pages_title; ?></strong>
                                        <input type="text" style="width: 0.1px;" id="<?php echo $c; ?>" name="link" value="<?php echo $url."/p/".str_replace(".txt", "", $pages); ?>.html">
                                    </td>
                                    <td>
                                        <a id="open" style="text-decoration: none;" href="<?php echo $url."/p/".str_replace(".txt", "", $pages); ?>.html" target="_blank"><button style="background-color: #00b300; padding: 0 5px; line-height: 30px; font-size: 12px; text-decoration: none; margin-bottom: 5px;" class="btn btn--radius-2 btn--blue-2" type="button">Buka</button>&nbsp;&nbsp;</a>
                                        <a id="link" style="text-decoration: none;" href="<?php echo $url."/p/".str_replace(".txt", "", $pages); ?>.html" target="_blank"><?php echo $url."/p/".str_replace(".txt", "", $pages); ?>.html&nbsp;&nbsp;</a>
                                        <button id="<?php echo $b; ?>" style="padding: 0 5px; line-height: 30px; font-size: 12px; text-decoration: none;" class="btn btn--radius-2 btn--blue-2" type="button" name="tamu">Salin</button>
                                        <script type="text/javascript">
                                            document.getElementById("<?php echo $b; ?>").addEventListener("click", function() {
                                            document.getElementById("<?php echo $b; ?>").innerHTML = "Disalin!";
                                            copyToClipboard(document.getElementById("<?php echo $c; ?>"));

                                        });
                                        </script>
                                    </td>
                                    <td class="center">    
                                        <form method="POST" action='' enctype="multipart/form-data">
                                        <input type="hidden" name="pageedit" value="<?php echo $pages; ?>">
                                        <input type="hidden" name="menu" value="Page">
                                        <button style="background-color: #F14E95; padding: 0 12px; line-height: 30px; font-size: 12px; text-decoration: none;" class="btn btn--radius-2 btn--blue-2 edit" type="submit">Edit</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>