                <?php 
                $setting = explode("\n", file_get_contents("../data/setting.txt"));
                $blog_title = $setting[0];
                $tagline = $setting[1];
                $home = $setting[2];
                $single = $setting[3];
                $randsingle = $setting[4];
                $randsidebar = $setting[5];
                $meta = explode("\n", file_get_contents("../data/meta.txt"));
                $bg = $setting[6];
                $ads1 = file_get_contents("../data/ads-code-1.txt");
                $ads2 = file_get_contents("../data/ads-code-2.txt");
                $counter = file_get_contents("../data/counter.txt");
                // notif status
                include 'notif.php';
                ?>
                <style type="text/css">
                    .card-body:before {
                        left: 177px !important;
                    }
                </style>
                <form method="POST" action='' enctype='multipart/form-data'>
                    <div class="card-body" style="margin-top: 50px;">
                        <div class="form-row">
                            <h3 style="font-weight: 700;">Setting</h3>
                        </div>
                        <div class="form-row">
                            <div class="name">Title<br><em style="font-weight: normal;">Blog</em></div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="title" placeholder="Blog" value="<?php echo $blog_title; ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Tagline<br><em style="font-weight: normal;">Blog</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="text" name="tagline" placeholder="Just a spam blog" value="<?php echo $tagline; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Meta Desc<br><em style="font-weight: normal;">on home</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="text" name="metades" placeholder="Just a spam blog" value="<?php echo $meta[0]; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Meta Keyword<br><em style="font-weight: normal;">on home</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="text" name="metakw" placeholder="keyword, kata kunci, tembung kasebut" value="<?php echo $meta[1]; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">How Many Posts<br><em style="font-weight: normal;">on home</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" style="width: 25%;" type="text" name="home" placeholder="6" value="<?php echo $home; ?>" required><br><em>numeric only</em>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">How Many Image<br><em style="font-weight: normal;">on single</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" style="width: 25%;" type="text" name="single" placeholder="6" value="<?php echo $single; ?>" required><br><em>numeric only</em>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">How Many Random Posts<br><em style="font-weight: normal;">on header single</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" style="width: 25%;" type="text" name="randsingle" placeholder="6" value="<?php echo $randsingle; ?>" required><br><em>numeric only</em>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">How Many Random Posts<br><em style="font-weight: normal;">on sidebar</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" style="width: 25%;" type="text" name="randsidebar" placeholder="6" value="<?php echo $randsidebar; ?>" required><br><em>numeric only</em>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Traffic Counter Code<br><em style="font-weight: normal;">ex: histats, statcounter, etc</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="counter" placeholder='Traffic Script'><?php echo $counter; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Ads Code 1<br><em style="font-weight: normal;">on header & content</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="ads1" placeholder='Ads Script'><?php echo $ads1; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Ads Code 2<br><em style="font-weight: normal;">on sidebar</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="ads2" placeholder='Ads Script'><?php echo $ads2; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <h3 style="font-weight: 700;">Admin</h3>
                        </div>
                        <div class="form-row">
                            <div class="name">Background<br><em style="font-weight: normal;">admin panel</em></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="text" name="bg" placeholder="6" value="<?php echo $bg; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align: right;">
                        <input type="hidden" name="menu" value="Setting">
                        <button id="load" style="background-color: #F14E95;" class="btn btn--radius-2 btn--blue-2" type="submit" name="savesetting">Simpan</button>
                    </div>
                </form>