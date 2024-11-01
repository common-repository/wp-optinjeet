<?php
require_once("versioninfo.php");
jeetoptinNotice();

if(!class_exists('optinJeet_admin'))
{
class optinJeet_admin {

    function optinJeet_all_area() {
        ?>
        <h1>Form Optin</h1>
        <div class="testvpadmin">
            <div class="testvpadminHead">
                <a href="javascript:;" onclick="tstVpadmn('testvp_CreateList');">Create New List</a>
                <a href="javascript:;" onclick="tstVpadmn('testvp_CreateOptin');">Create New Optin</a>
                <a href="javascript:;" onclick="tstVpadmn('testvp_DiaplayList');">Show All Lists</a>
                <a href="javascript:;" onclick="tstVpadmn('testvp_DisplayOptin');">Show All Optins</a>
            </div>
        </div>
        <div class="clr"></div>
        <?php
        $this->optinJeet_CreateList();
        $this->optinJeet_CreateOptin();
        $this->optinJeet_DisplayList();
        $this->optinJeet_DisplayOptin();
    }

    function optinJeet_CreateList() {
        if (isset($_POST["formoptinlist"])) {
            // echo"ssss";
             $editFlag = isset($_POST["editID"]) ? sanitize_text_field($_POST["editID"]) : "";
            if ($editFlag == "") {
                //echo"S";
                $my_post = array(
                    'post_title' => sanitize_text_field($_POST["title"]),
                    'post_status' => 'publish',
                    'post_type' => "optinformList"
                );

                 $post_id = wp_insert_post($my_post);
            } else {
                $my_post = array(
                    'ID' => $editFlag,
                    'post_title' => sanitize_text_field($_POST["title"]),
                    'post_status' => 'publish',
                    'post_type' => "optinformList"
                );

                wp_update_post($my_post);
                $post_id = $editFlag;
            }
            $tempvalue = sanitize_text_field($_POST["tmpvalue"]);
            for ($i = 1; $i <= $tempvalue; $i++) {
                if ($i == "1") {
                    if (isset($_POST["reqrd"]) && ($_POST["reqrd"] != "1")) {
                        $reqrd = "0";
                    } else {
                        $reqrd = "1";
                    }
                    $data = "Email_email_1";
                } else {
                    $m = $i - 1;
                    if ((isset($_POST["reqrd" . $m])) &&  ($_POST["reqrd" . $m] != "1")) {
                        $reqrd = "0";
                    } else {
                        $reqrd = "1";
                    }
                    if(!isset($_POST["name" . $m]) && isset($_POST["name"]))
                    {
                        $data = $data . "," . sanitize_text_field($_POST["name"]) . "_" . sanitize_text_field($_POST["type" . $m]) . "_" . $reqrd;
                    }
                    else
                    {
                        $data = $data . "," . sanitize_text_field($_POST["name" . $m]) . "_" . sanitize_text_field($_POST["type" . $m]) . "_" . $reqrd;
                    }
                }
            }
            $msg = "Updated";
            if ($editFlag == "") {
                $msg = "Created";
            }
            if ($post_id != "") {
                // echo"SS";
                update_post_meta($post_id, "optin_From_List_Fields", $data);
                 echo " <p class='form-submit-successOPtin' style='color: green'>List " . esc_html($msg) . " Successfully</p>";
              echo "<script>window.location='admin.php?page=sub-optinJeet_list';</script>";
            } else {
                echo " <p class='form-submit-errorOPtin' style='color: green'>There is some error please try again</p>";
            }
        }
        $upDateID = isset($_GET["upDateID"]) ? sanitize_text_field($_GET["upDateID"]) : "";
        $savedTitle = "";
        $TotalSizeFields = "1";
        $submitValue = "Create List";
        $LabelOptin = "Add List";
        $rstBtn = "<input type='reset' value='Reset' id='OptinReset'>";
        if ($upDateID != "") {
            $rstBtn = "";
            $LabelOptin = "Here you can update List name";
            $submitValue = "Update List";
            $SavedPost = get_post($upDateID);
            $savedTitle = $SavedPost->post_title;
            $allFieldsArray = explode(",", get_post_meta($upDateID, "optin_From_List_Fields", true));
            $TotalSizeFields = sizeof($allFieldsArray);
        }
        ?>
        <div class="testvpTabContant testvpactive" id="testvp_CreateList">
            <h1><?php echo esc_html($LabelOptin); ?></h1>
            <form method="post">
                <?php
                if ($upDateID != "") {
                    echo "<input type='hidden' name='editID' value='" . esc_attr($upDateID) . "'>";
                }
                ?>


                <h4>List Name</h4>
                <input required type="text" pattern="[a-zA-Z][a-zA-Z0-9\s]*" value="<?php echo esc_attr($savedTitle); ?>" name="title"><br><br>
                <a class="OptinListbtn" onclick="addoptinelement();" id="addElementOptinList" href="javascript:;">+</a><br>

                <input type="hidden" name="tmpvalue" id="tmpvalue" value="<?php echo esc_attr($TotalSizeFields); ?>">

                <div class="adcontenthtml">
                    <div class="formcontentOptin">
                        <div class="fieldelementoptin">
                            <b>Field Name</b><br>
                            <input type="text" disabled name="email" value="email">
                        </div>
                        <div class="fieldelementoptin">
                            <b>Type</b><br>
                            <select name="type" disabled>
                                <option value="text">text</option>
                                <option selected value="email">email</option>
                                <option value="number">phone</option>
                            </select>
                        </div>
                        <div class="fieldelementoptin">
                            <b>Required</b><br>
                            <input style=" margin-top: 8px;" type="checkbox" checked="checked" disabled name="reqrd" value="1">
                        </div>

                        <div class="fieldelementoptin"><br>
                            <a style="margin-left:0px !important;" class="OptinListbtnrmv" href="javascript:;" id="rmv">x</a>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <?php
                    if ($upDateID != "") {
                        $im = "0";
                        foreach ($allFieldsArray as $allFieldsSingle) {
                            if ($im > "0") {
                                $ElementArray = explode("_", $allFieldsSingle);
                                ?>
                                <div class="formcontentOptin" id="singleoptinrow<?php echo esc_attr($im); ?>">
                                    <div class="fieldelementoptin">

                                        <input required type="text" pattern="[a-zA-Z][a-zA-Z0-9\s]*" value="<?php echo esc_attr($ElementArray['0']); ?>" name="name<?php echo esc_attr($im); ?>" id="jeetOptinname">
                                    </div>
                                    <div class="fieldelementoptin">

                                        <select required name="type<?php echo esc_attr($im); ?>" id="jeetOptintype">
                                            <option <?php
                                            if ($ElementArray['1'] == "text") {
                                                echo "selected";
                                            }
                                            ?> value="text">text</option>
                                            <option <?php
                                            if ($ElementArray['1'] == "email") {
                                                echo "selected";
                                            }
                                            ?> value="email">email</option>
                                            <option <?php
                                            if ($ElementArray['1'] == "number") {
                                                echo "selected";
                                            }
                                            ?> value="number">phone</option>
                                        </select>
                                    </div>
                                    <div class="fieldelementoptin">

                                        <input type="checkbox" <?php
                                        if ($ElementArray['2'] == "1") {
                                            echo "checked='checked'";
                                        }
                                        ?> name="reqrd<?php echo esc_attr($im); ?>" id="jeetOptinrqrd" value="1">
                                    </div>
                                    <div class="fieldelementoptin">
                                        <a href="javascript:;" onclick="rmvfieldOptin('<?php echo esc_attr($im); ?>')" class="OptinListbtnrmv" id="rmv">x</a>
                                    </div>
                                </div>
                                <div class="clr"></div>
                                <?php
                            }

                            $im++;
                        }
                    }
                    ?>
                </div>
                <input type="submit" name="formoptinlist" value="<?php echo esc_attr($submitValue); ?>">
                <?php echo $rstBtn; ?>
            </form>
        </div>
        <div class="fieldsListOptin" style="display:none">
            <div class="formcontentOptin" id="singleoptinrow<?php echo esc_attr($TotalSizeFields); ?>">
                <div class="fieldelementoptin">

                    <input required type="text" pattern="[a-zA-Z][a-zA-Z0-9\s]*" name="name<?php esc_attr($TotalSizeFields); ?>" id="jeetOptinname">
                </div>
                <div class="fieldelementoptin">

                    <select required name="type<?php echo esc_attr($TotalSizeFields); ?>" id="jeetOptintype">
                        <option value="text">text</option>
                        <option value="email">email</option>
                        <option value="number">phone</option>
                    </select>
                </div>
                <div class="fieldelementoptin">

                    <input type="checkbox" name="reqrd<?php echo esc_attr($TotalSizeFields); ?>" id="jeetOptinrqrd" value="1">
                </div>
                <div class="fieldelementoptin">
                    <a href="javascript:;" onclick="rmvfieldOptin('<?php echo esc_attr($TotalSizeFields); ?>')" class="OptinListbtnrmv" id="rmv">x</a>
                </div>
            </div>
            <div class="clr"></div>
        </div>
        <?php
    }

    function optinJeet_CreateOptin() {
        if (isset($_POST["optinFormSubmit"])) {
            $name = sanitize_text_field($_POST["opTinName"]);
            $list = sanitize_text_field($_POST["selectList"]);
            $flag = sanitize_text_field($_POST["redirectFlag"]);
            $rurl = sanitize_text_field($_POST["redirectUrlOptin"]);
            $updateID = isset($_POST["Update_ID"]) ? sanitize_text_field($_POST["Update_ID"]) : "";
            if ($updateID == "") {
                $my_post = array(
                    'post_title' => $name,
                    'post_status' => 'publish',
                    'post_type' => "optinformOptins",
                    'post_content' => $list
                );
                $post_id = wp_insert_post($my_post);
            } else {
                $my_post = array(
                    'ID' => $updateID,
                    'post_title' => $name,
                    'post_status' => 'publish',
                    'post_type' => "optinformOptins",
                    'post_content' => $list
                );
                wp_update_post($my_post);
                $post_id = $updateID;
            }
            $rdrctUrl = "";

            update_post_meta($post_id, "optint_redUrl_Flag", $flag);
            update_post_meta($post_id, "optint_Url_link", $rurl);
            if ($flag == "1") {

                $rdrctUrl = "<input type='hidden' name='rdrct' value='" . esc_attr($rurl) . "' >";
            }
            $extFieldsArray = $_POST["a"];
            $exTmp = "1";
            foreach ($extFieldsArray as $extFields) {
                $extFields=sanitize_text_field($extFields);
                if ($exTmp == "1") {
                    $lfds = $extFields;
                } else {
                    $lfds = $lfds . "," . $extFields;
                }
                $exTmp++;
            }

            $fields = explode(",", $lfds);
            $fieldSize = sizeof($fields);
            for ($i = "0"; $i < $fieldSize; $i++) {
                $fldAray = explode("_", $fields[$i]);
                $reqrd = "";
                if ($fldAray["2"] == "1") {
                    $reqrd = "required";
                }
                if ($i == "0") {

                    $content = "
                     <div class='form_row'><label for='" . esc_attr($fldAray['0']) . "'>" . esc_html($fldAray['0']) . "</label>
                    <input type='" . esc_attr($fldAray['1']) . "' name='email' " . esc_attr($reqrd) . " id='" . esc_attr($fldAray['0']) . "'></div>";
                } else {
                    if($fldAray['1']!="email" && $fldAray['1']!="number" && $fldAray["2"] == "1"){
                    $reqrd = "required pattern='[a-zA-Z][a-zA-Z0-9\s]*'";
                }
                    $content = $content . "<div class='form_row'><label for='" . esc_attr($fldAray['0']) . "'>" . esc_html($fldAray['0']) . "</label>
                    <input type='" . esc_attr($fldAray['1']) . "' name='OptinFld" . esc_attr($i) . "' " . esc_attr($reqrd) . " id='" . esc_attr($fldAray['0']) . "'></div>";
                }
            }
            $url = "";
            $args = array(
                'posts_per_page' => -1,
                'post_type' => 'page',
                'post_status' => 'publish'
            );
            $stsOfTm = "0";
            $posts_array = get_posts($args);
            foreach ($posts_array as $pstssingle) {
                if ($pstssingle->post_title == "Thankyou") {
                    $stsOfTm = "1";
                    update_post_meta($pstssingle->ID, "FromUrlOptin", get_permalink($pstssingle->ID));
                    $post_id1 = $pstssingle->ID;
                }
            }
            if ($stsOfTm == "0") {
                $my_post = array(
                    'post_title' => "Thankyou",
                    'post_status' => 'publish',
                    'post_type' => 'page',
                    'post_content' => "[leadGenerate_jeetOptin]
                    <center><h1>
                     Thanks For Your Submission.
                    </h1><br><script>
function goBack() {
    window.history.back();
}
</script>
                     <a id='optinBtnbck' onclick='goBack()' href='javascript:;'>Back To Form</a></center>
                    "
                );
                $post_id1 = wp_insert_post($my_post);
                update_post_meta($post_id1, "FromUrlOptin", get_permalink($post_id1));
            }
            if (get_post_meta($post_id1, "FromUrlOptin", true) != "") {
                 $url = get_post_meta($post_id1, "FromUrlOptin", true);
            }
              $lstttl=get_post($list);
            $form = '
            
                <form id="formlead" method="get" onsubmit="this.submit(); this.reset(); return false;" action="' . esc_url($url) . '">
                    <div class="optin">
                    <h2>' . esc_html($name) . ' Form</h2>
                    <input type="hidden" name="listName" value="' . esc_attr($lstttl->post_title) . '" />
                    <input type="hidden" name="lfds23" value="' . esc_attr($lfds) . '" />
                        <input type="hidden" name="optinid" value="' . esc_attr($post_id) . '" />
                <input type="hidden" name="totalFields" value="' . esc_attr($fieldSize) . '" />
                        <input type="hidden" name="flag" value="' . esc_attr($flag) . '" />
                        ' . esc_html($rdrctUrl) . '
                        <div id="fields">' . esc_html($content) . '<br />
						<input type="checkbox" id="consent" name="consent" required /> I agree to receive email from you including marketing messages.</div>
						
						<div class=""><input type="submit" name="OptinFormValues" value="Submit" /></div>
                </div>
                </form>
                            ';
            $msg = "Updated";
            if ($updateID == "") {
                $msg = "Created";
            }
            if ($post_id != "") {
                update_post_meta($post_id, "Optin_Form_Html", $form);
                update_post_meta($post_id, "Optin_Flds_fld", $lfds);
                if ($updateID != "") {
                   echo " <p class='form-submit-successOPtin' style='color: green'>Optin " . esc_html($msg) . " Successfully</p>";
                      echo "<script>window.location='admin.php?page=sub-optinJeet_Optin';</script>";

                } else {
                    // echo $post_id;
                     echo "<script>window.location='admin.php?page=sub-optinJeet_Optin&OptinID=".$post_id."';</script>";
                    
                }
            } else {
                echo " <p class='form-submit-errorOPtin' style='color: green'>There is some error please try again</p>";
            }
        }
        $edit = isset($_GET["editID"]) ? sanitize_text_field($_GET["editID"]) : "";
        $titleOptn = "";
        $OptnListID = "";
        $optinrdrctFlag = "";
        $optinrdrctUrl = "";
        $submitValue = "Generate Optin";
        $rstBtn = "<input type='reset' value='Reset' id='OptinReset'>";
        $LabelOptin = "Add Optin";
        if ($edit != "") {
            $rstBtn = "";
            $LabelOptin = "Update Optin";
            $submitValue = "Update Optin";
            $savedPost = get_post($edit);
            $titleOptn = $savedPost->post_title;
            $OptnListID = $savedPost->post_content;
            $dsbld = "disabled";
            $optinrdrctFlag = get_post_meta($edit, "optint_redUrl_Flag", true);
            if ($optinrdrctFlag == "1") {
                $optinrdrctFlag = "checked='checked'";
                $dsbld = "";
            }
            $optinrdrctUrl = get_post_meta($edit, "optint_Url_link", true);
        }
        ?>
        <div class="testvpTabContant" id="testvp_CreateOptin">
            <h1><?php echo esc_html($LabelOptin); ?></h1>
            <div class="jeetCreateOptin">
                <form action="" method="post">
                    <?php
                    if ($edit != "") {
                        echo "<input type='hidden' name='Update_ID' value='" . esc_attr($edit) . "' >";
                    }
                    ?>
                    <div>
                        Optin Name<br>
                        <input type="text" pattern="[a-zA-Z][a-zA-Z0-9\s]*" required name="opTinName" value="<?php echo esc_attr($titleOptn); ?>">
                    </div>
                    <div class="jeetCreateOptinLayout">
                        <div class="fieldelementoptin">
                            Select List<br>
                            <select name="selectList" required onchange="rlVlues(this.value)">
                                <option value="">--Select List--</option>
                                <?php
                                $args = array(
                                    'posts_per_page' => -1,
                                    'post_type' => 'optinformList',
                                    'post_status' => 'publish'
                                );
                                $posts_array = get_posts($args);
                                global $post;
                                foreach ($posts_array as $post):setup_postdata($post);
                                    ?>

                                    <option <?php
                                    if ($OptnListID == $post->ID) {
                                        echo "selected";
                                    }
                                    ?> value="<?php the_ID(); ?>"><?php the_title(); ?></option>


                                    <?php
                                endforeach;
                                wp_reset_postdata();
                                ?>
                            </select>   
                        </div>
                        <div class="clr"></div>
                        <div class="fieldelementoptin">
                            <input onclick="vldUrl();tstchckdornt();" id="optinRdrctChckd" type="checkbox" <?php echo esc_html($optinrdrctFlag); ?> name="redirectFlag" value="1"> Set Redirect URL ?
                        </div>
                        <div class="clr"></div>
                        <div class="fieldelementoptin">
                            <input oninput="vldUrl();" type="text" id="redirectUrlOptin23" <?php echo esc_html($dsbld); ?> name="redirectUrlOptin" value="<?php echo esc_attr($optinrdrctUrl); ?>" placeholder="Enter Redirect Url">
                            <span style="color:red" id="vldUrl"></span>
                        </div>
                        <div class="clr"></div>
                        <h4>Optin Fields</h4>
                        <div class="optinsRealFields">
                            <?php
                            if ($edit != "") {
                                $ltm = "1";
                                $OptnListfldArray = explode(",", get_post_meta($OptnListID, "optin_From_List_Fields", true));
                                foreach ($OptnListfldArray as $OptnListfldsingle) {
                                    $OptnListfldName = explode("_", $OptnListfldsingle);
                                    $optnChekd = "";
                                    $rowCondArray = explode(",", get_post_meta($edit, "Optin_Flds_fld", true));
                                    if ($ltm == "1") {
                                        ?>
                                        <input type="checkbox"disabled checked="checked" ><?php echo esc_html($OptnListfldName["0"]); ?>
                                        <input type="hidden" name="a[]" value="<?php echo esc_attr($OptnListfldsingle) ?>">
                                        <?php
                                    } else {
                                        foreach ($rowCondArray as $rowCondSingle) {
                                            $rowcondCell = explode("_", $rowCondSingle);
                                            if ($rowcondCell["0"] == $OptnListfldName["0"]) {
                                                $optnChekd = "checked='checked'";
                                            }
                                        }
                                        if ($OptnListfldName["2"] == "1") {
                                            $optnChekd = "checked='checked' disabled";
                                            ?>
                                            <input type="hidden" name="a[]" value="<?php echo esc_attr($OptnListfldsingle); ?>">
                                            <?php
                                        }
                                        ?>


                                        <br><input <?php echo $optnChekd; ?> type="checkbox" name="a[]"  value="<?php echo esc_attr($OptnListfldsingle); ?>"><?php echo esc_html($OptnListfldName["0"]); ?>
                                        <?php
                                    } $ltm++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div>
                        <input type="submit" name="optinFormSubmit" value="<?php echo esc_attr($submitValue); ?>">
                        <?php echo $rstBtn; ?>
                    </div>

                </form>
                <div style="display:none">
                    <?php
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'optinformList',
                        'post_status' => 'publish'
                    );
                    $posts_array = get_posts($args);
                    global $post;
                    foreach ($posts_array as $post):setup_postdata($post);
                        ?>
                        <div id="<?php echo $post->ID . "tmpID" ?>">
                            <?php
                            $i = "1";
                            $exArray = explode(",", get_post_meta($post->ID, 'optin_From_List_Fields', true));
                            foreach ($exArray as $exVal) {
                                $ex1Array = explode("_", $exVal);
                                if ($i == "1") {
                                    ?>
                                    <input type="checkbox" disabled checked="checked" ><?php echo esc_html($ex1Array["0"]); ?>
                                    <input type="hidden" name="a[]" value="<?php echo esc_attr($exVal); ?>">
                                    <?php
                                } else {
                                    $optnChekd1 = "";
                                    if ($ex1Array["2"] == "1") {
                                        $optnChekd1 = "checked='checked' disabled";
                                        ?>
                                        <input type="hidden" name="a[]" value="<?php echo esc_attr($exVal); ?>">
                                        <?php
                                    }
                                    ?>

                                    <br><input <?php echo $optnChekd1; ?> name="a[]" type="checkbox"  value="<?php echo esc_attr($exVal); ?>"><?php echo esc_html($ex1Array["0"]); ?>
                                    <?php
                                } $i++;
                            }
                            ?>
                        </div>
                        <?php
                    endforeach;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    function optinJeet_DisplayList() {
        $rwpstdata = isset($_POST["lsttitle"]) ? sanitize_text_field($_POST["lsttitle"]) : "";
        if ($rwpstdata != "") {
            $my_post3 = array(
                'post_title' => $rwpstdata,
                'post_status' => 'publish',
                'post_type' => "optinformList"
            );

            $post_id3 = wp_insert_post($my_post3);
            update_post_meta($post_id3, "optin_From_List_Fields", "Email_email_1");
            echo " <p class='form-submit-successOPtin' style='color: green'>List Added Successfully</p>";
        }
        $msg = isset($_GET["msg"]) ? sanitize_text_field($_GET["msg"]) : "";
        if ($msg != "") {
            echo " <p class='form-submit-successOPtin' style='color: green'>List " . esc_html($msg) . " Successfully</p>";
        }
        ?>

        <script class="init">
            jQuery(document).ready(function ($) {

                var table = $('#datatable_ajax1').dataTable({
                    "sDom": 'T<"clear">lfrtip',
                    "aLengthMenu": [[10, 25, 50, 100, 200, 500, 1000], [10, 25, 50, 100, 200, 500, 1000]],

                    "oTableTools": {
                        "sSwfPath": "<?php echo esc_html(optinjeet_pluginurl).'/datatables-1.9.4/tabletools-2.2.0/swf/copy_csv_xls_pdf.swf'; ?>",
                        "aButtons": [
                            {
                                "sExtends": "xls",
                                "sButtonText": "<i class='fa fa-save'></i> EXCEL",
                                "mColumns": [0, 1, 2, 3],
                                "sTitle": "List<?php echo date('Ymd'); ?>",
                            },
                            {
                                "sExtends": "csv",
                                "sButtonText": "<i class='fa fa-save'></i> CSV",
                                "mColumns": [0, 1, 2, 3],
                                "sTitle": "List<?php echo date('Ymd'); ?>",
                            },
                            {
                                "sExtends": "pdf",
                                "sButtonText": "<i class='fa fa-save'></i> PDF",
                                "sPdfOrientation": "landscape",
                                "sPdfSize": "tabloid",
                                "mColumns": [0, 1, 2, 3],
                                "sTitle": "List<?php echo date('Ymd'); ?>",

                            },
                            {
                                "sExtends": "print",
                                "sButtonText": "<i class='fa fa-save'></i> PRINT",
                                "sPdfOrientation": "landscape",
                                "sPdfSize": "tabloid",
                                "mColumns": [0, 1, 2, 3],
                                "sTitle": "List<?php echo date('Ymd'); ?>",
                            }
                        ]
                    },

                });

            });
        </script>
     
        <div class="testvpTabContant" id="testvp_DiaplayList">
            <h1>All Lists</h1>
            <a class="OptinListbtn1" href="<?php echo home_url() . '/wp-admin/admin.php?page=sub-createoptinJeet_list'; ?>">Create New List</a>
            <a id='roWlstadd' class="OptinListbtn1"  onclick="newRowList1();" href="javascript:;">Add Row</a>
            <div class="optinForm_list">
            <div class="table-responsive">
                <table id="datatable_ajax1" class="lsttbl table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>List Name</th>
                            <th>Total Leads</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $args = array(
                            'posts_per_page' => -1,
                            'post_type' => 'optinformList',
                            'post_status' => 'publish'
                        );
                        $posts_array = get_posts($args);
                        global $post;
                        foreach ($posts_array as $post):setup_postdata($post);
                            $args1 = array(
                                'posts_per_page' => -1,
                                'post_type' => "optinListVal_" . $post->ID,
                                'post_status' => 'publish'
                            );
                            $posts_array1 = get_posts($args1);
                            $i = "0";
                            foreach ($posts_array1 as $pst) {
                                $i++;
                            }
                            ?>
                            <tr>
                                <td><a href="<?php echo home_url() . '/wp-admin/admin.php?page=sub-optinJeet_list&upID=' . $post->ID; ?>"><?php the_title(); ?></a></td>
                                <td><?php echo esc_html($i); ?> </td>
                                <td><?php echo get_the_date('d M Y H:i:s', $post->ID); ?></td>
                                <td><a onclick="return confirm('Are you sure want to delete this record ?')" href="<?php echo esc_url(home_url() . '/wp-admin/admin.php?page=sub-optinJeet_list&deleteID=' . $post->ID); ?>">Delete</a> | <a href="<?php echo esc_url(home_url() . '/wp-admin/admin.php?page=sub-createoptinJeet_list&upDateID=' . $post->ID); ?>">Edit</a></td>
                            </tr>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                    </tbody>
                </table>
                    </div>
            </div>

        </div>
        <?php
    }

    function optinJeet_DisplayOptin() {
        $msg = isset($_GET["msg"]) ? sanitize_text_field($_GET["msg"]) : "";
        if ($msg != "") {
            echo " <p class='form-submit-successOPtin' style='color: green'>Optin " . esc_html($msg) . " Successfully</p>";
        }
        ?>
        <script class="init">
            jQuery(document).ready(function ($) {

                var table = $('#datatable_ajax2').dataTable({
                    "sDom": 'T<"clear">lfrtip',
                    "aLengthMenu": [[10, 25, 50, 100, 200, 500, 1000], [10, 25, 50, 100, 200, 500, 1000]],

                    "oTableTools": {
                        "sSwfPath": "<?php echo esc_url(optinjeet_pluginurl.'/datatables-1.9.4/tabletools-2.2.0/swf/copy_csv_xls_pdf.swf'); ?>",
                        "aButtons": [
                            {
                                "sExtends": "xls",
                                "sButtonText": "<i class='fa fa-save'></i> EXCEL",
                                "mColumns": [0, 1, 2, 3],
                                "sTitle": "optinlist<?php echo date('Ymd'); ?>",
                            },
                            {
                                "sExtends": "csv",
                                "sButtonText": "<i class='fa fa-save'></i> CSV",
                                "mColumns": [0, 1, 2, 3],
                                "sTitle": "optinlist<?php echo date('Ymd'); ?>",
                            },
                            {
                                "sExtends": "pdf",
                                "sButtonText": "<i class='fa fa-save'></i> PDF",
                                "sPdfOrientation": "landscape",
                                "sPdfSize": "tabloid",
                                "mColumns": [0, 1, 2, 3],
                                "sTitle": "optinlist<?php echo date('Ymd'); ?>",

                            },
                            {
                                "sExtends": "print",
                                "sButtonText": "<i class='fa fa-save'></i> PRINT",
                                "sPdfOrientation": "landscape",
                                "sPdfSize": "tabloid",
                                "mColumns": [0, 1, 2, 3],
                                "sTitle": "optinlist<?php echo date('Ymd'); ?>",
                            }
                        ]
                    },

                });

            });
        </script>
        <div class="testvpTabContant" id="testvp_DisplayOptin">
            <h1>Optins</h1>
            <a class="OptinListbtn1" href="<?php echo home_url() . '/wp-admin/admin.php?page=sub-createoptinJeet_Optin'; ?>">Create New Optin</a>
            <div class="optinForm_list">
            <div class="table-responsive">
                <table id="datatable_ajax2" class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>Optin Name</th>
                            <th>List Name</th>
                            <th>Total Leads</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $args = array(
                            'posts_per_page' => -1,
                            'post_type' => 'optinformOptins',
                            'post_status' => 'publish'
                        );
                        $posts_array = get_posts($args);
                        global $post;
                        foreach ($posts_array as $post):setup_postdata($post);
                            $pstContent = get_post($post->post_content);
                            $args1 = array(
                                'posts_per_page' => -1,
                                'post_type' => "optinListVal_" . $post->post_content,
                                'post_status' => 'publish'
                            );
                            $posts_array1 = get_posts($args1);
                            $i = "0";
                            foreach ($posts_array1 as $pst) {
                                $i++;
                            }
                            ?>
                            <tr>
                                <td><a href="<?php echo home_url() . '/wp-admin/admin.php?page=sub-optinJeet_Optin&OptinID=' . $post->ID; ?>"><?php the_title(); ?></a></td>
                                <td><a href="<?php echo home_url() . '/wp-admin/admin.php?page=sub-optinJeet_list&upID=' . $post->post_content; ?>"><?php echo esc_html($pstContent->post_title); ?></a></td>
                                <td><?php echo esc_html($i); ?> </td>

                                <td><a onclick="return confirm('Are you sure want to delete this record ?')" href="<?php echo esc_url(home_url().'/wp-admin/admin.php?page=sub-optinJeet_Optin&deleteID='.$post->ID); ?>">Delete</a> | <a href="<?php echo esc_url(home_url() . '/wp-admin/admin.php?page=sub-createoptinJeet_Optin&editID=' . $post->ID); ?>">Edit</a></td>
                            </tr>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                    </tbody>
                </table>
                    </div>
            </div>
        </div>
        <?php
    }

    function form_Optin_Data() {
        $filter = isset($_GET["OptinID"]) ? sanitize_text_field($_GET["OptinID"]) : "";
        $fltr2 = get_post($filter);
        if ($filter != "") {
            ?>

            <h1>Optin form <?php echo esc_html($fltr2->post_title); ?></h1>
            <a class="OptinListbtn1" href="<?php echo esc_url(home_url() .'/wp-admin/admin.php?page=sub-optinJeet_Optin'); ?>">Back To Optins</a>
            <a onclick="copyToClipboard('#cpy');" class="OptinListbtn1"   href="javascript:;">Copy Form</a>
            <div class="clr" ></div><br>
            <textarea  id='cpy' style="height: 500px;width: 850px; resize: both;"><?php echo esc_html(get_post_meta($filter, "Optin_Form_Html", true)); ?></textarea>
            <?php
        } else {
            $delete = isset($_GET["deleteID"]) ? sanitize_text_field($_GET["deleteID"]) : "";
            if ($delete != "") {
                global $wpdb;
                $wpdb->delete($wpdb->posts, array('ID' => $delete));
                $wpdb->delete($wpdb->postmeta, array('ID' => $delete));
                echo "<p class='form-submit-errorOPtin' style='color: green'>Optin Deleted</p>";
            }
            echo "<div class='singLeOptinMenu'>";
            $this->optinJeet_DisplayOptin();
            echo "</div>";
        }
    }

    function form_Leads_Data() {
        $filter = isset($_GET["upID"]) ? sanitize_text_field($_GET["upID"]) : "";
        if ($filter != "") {
            $delete = isset($_GET["dlt"]) ? sanitize_text_field($_GET["dlt"]) : "";
            if ($delete != "") {
                global $wpdb;
                $wpdb->delete($wpdb->posts, array('ID' => $delete));
                $wpdb->delete($wpdb->postmeta, array('ID' => $delete));
                echo "<p class='form-submit-errorOPtin' style='color: green'>Lead Deleted</p>";
            }
            $args1 = array(
                'posts_per_page' => -1,
                'post_type' => "optinListVal_" . $filter,
                'post_status' => 'publish'
            );
            $posts_array1 = get_posts($args1);
            $sngPst = get_post($filter);
            ?>
            <script class="init">
                jQuery(document).ready(function ($) {

                    var table = $('#datatable_ajax4').dataTable({
                        "sDom": 'T<"clear">lfrtip',
                        "aLengthMenu": [[10, 25, 50, 100, 200, 500, 1000], [10, 25, 50, 100, 200, 500, 1000]],

                        "oTableTools": {
                            "sSwfPath": "<?php echo esc_html(optinjeet_pluginurl.'/datatables-1.9.4/tabletools-2.2.0/swf/copy_csv_xls_pdf.swf'); ?>",
                            "aButtons": [
                                {
                                    "sExtends": "xls",
                                    "sButtonText": "<i class='fa fa-save'></i> EXCEL",
                                    "sTitle": "lead<?php echo date('Ymd'); ?>",

                                },
                                {
                                    "sExtends": "csv",
                                    "sButtonText": "<i class='fa fa-save'></i> CSV",
                                    "sTitle": "lead<?php echo date('Ymd'); ?>",

                                },
                                {
                                    "sExtends": "pdf",
                                    "sButtonText": "<i class='fa fa-save'></i> PDF",
                                    "sPdfOrientation": "landscape",
                                    "sPdfSize": "tabloid",
                                    "sTitle": "lead<?php echo date('Ymd'); ?>",

                                },
                                {
                                    "sExtends": "print",
                                    "sButtonText": "<i class='fa fa-save'></i> PRINT",
                                    "sPdfOrientation": "landscape",
                                    "sPdfSize": "tabloid",
                                    "sTitle": "lead<?php echo date('Ymd'); ?>",

                                }
                            ]
                        },

                    });

                });
            </script>
            <h1><?php echo esc_html($sngPst->post_title); ?> Leads</h1>
            <div class="optinForm_list">
            <div class="table-responsive">
                <table id="datatable_ajax4" class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <?php
                            $fldsArray = explode(",", get_post_meta($filter, "optin_From_List_Fields", true));
                            foreach ($fldsArray as $flds) {
                                $rlcn = explode("_", $flds);
                                echo "<th>" . esc_html($rlcn["0"]) . "</th>";
                            }
                            ?>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($posts_array1 as $pst) {
                            echo "<tr>";
                            $pst1Array = explode("_", $pst->post_content);
                            foreach ($pst1Array as $pst1) {
                                echo "<td>";
                                echo esc_html($pst1);
                                echo "</td>";
                            }
                            ?>
                        <td><a onclick="return confirm('Are you sure want to delete this record ?')"  href="<?php echo esc_url(home_url() . '/wp-admin/admin.php?page=sub-optinJeet_list&upID=' . $filter . '&dlt=' . $pst->ID); ?>">Delete</a></td>
                        <?php
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
            <?php
        } else {
            $delete = isset($_GET["deleteID"]) ? sanitize_text_field($_GET["deleteID"]) : "";
            if ($delete != "") {
                global $wpdb;
                $wpdb->delete($wpdb->posts, array('ID' => $delete));
                $wpdb->delete($wpdb->postmeta, array('ID' => $delete));
                $wpdb->delete($wpdb->posts, array('post_content' => $delete));
                echo "<p class='form-submit-errorOPtin' style='color: green'>List Deleted</p>";
            }
            echo "<div class='singLeOptinMenu'>";
            $this->optinJeet_DisplayList();
            echo "</div>";
        }
    }

    function saveLeadOptin() {
        if ($_GET["totalFields"] != "0" && $_GET["totalFields"] != "" && $_GET["optinid"] != "") {
            $id = get_post(sanitize_text_field($_GET["optinid"]));			
            $lfds23 = sanitize_text_field($_GET["lfds23"]);
            for ($i = "0"; $i < $_GET["totalFields"]; $i++) {
                if ($i == "0") {
                    $data = sanitize_text_field($_GET["email"]);
                } else {
                    $ltm = "1";

                    $OptnListfldArray = explode(",", get_post_meta($id->post_content, "optin_From_List_Fields", true));
                    foreach ($OptnListfldArray as $OptnListfldsingle) {
                        $dispSts = "0";
                        $OptnListfldName = explode("_", $OptnListfldsingle);
                        $rowCondArray = explode(",", $lfds23);
                        if ($ltm != "1") {
                            foreach ($rowCondArray as $rowCondSingle) {
                                $rowcondCell = explode("_", $rowCondSingle);

                                if ($rowcondCell["0"] == $OptnListfldName["0"]) {
                                    $dispSts = "1";
                                }
                            }
                            if ($dispSts == "1") {
                                $data = $data . "_" . sanitize_text_field($_GET["OptinFld" . $i]);
                                $i++;
                            } else {
                                $data = $data . "_ ";
                            }
                        } $ltm++;
                    }
                }
            }
            $args1 = array(
                'posts_per_page' => -1,
                'post_type' => "optinListVal_" . $id->post_content,
                'post_status' => 'publish'
            );
            $posts_array1 = get_posts($args1);
            $sts = "0";
            if ($_GET["email"] == "") {
                $sts = "1";
            }
            foreach ($posts_array1 as $keyVal) {
                if ($keyVal->post_title == $_GET["email"]) {
                    $sts = "1";
                }
            }
            if ($sts == "0") {
                $my_post = array(
                    'post_title' => sanitize_text_field($_GET["email"]),
                    'post_status' => 'publish',
                    'post_type' => "optinListVal_" . $id->post_content,
                    'post_content' => $data
                );
                $post_id = wp_insert_post($my_post);
                update_post_meta($post_id, "Optin_ID", sanitize_text_field($_GET["optinid"]));
                update_post_meta($post_id, "Optin_List_ID", $id->post_content);

                $idGet = get_the_ID();
                $Frdt = get_post($id->post_content);
                $data1 = "[leadGenerate_jeetOptin]";
                echo "<center><h1>
                     Thanks for signing up to " . esc_html($_GET['listName']) . ".
                    </h1><br><script>
function goBack() {
    window.history.back();
}
</script>
                     <a id='optinBtnbck' onclick='goBack()' href='javascript:;'>Back To Form</a></center>
                    ";
                $my_post3 = array(
                    'ID' => $idGet,
                    'post_content' => $data1
                );
                $post_id3 = wp_update_post($my_post3);
            } else {
                echo "<p class='form-submit-errorOPtin' style='color: green'>Email Already Exists</p>";
                echo "<center><h1>
                     Sorry for signing up to " . esc_html($_GET['listName']) . ".
                    </h1><br><script>
function goBack() {
    window.history.back();
}
</script>
                     <a id='optinBtnbck' onclick='goBack()' href='javascript:;'>Back To Form</a></center>
                    ";
            }

            if ($_GET["flag"] == "1") {
                if ($_GET["rdrct"] != "") {
                    wp_redirect(sanitize_text_field($_GET["rdrct"]));
                }
            }
			
        }		
    }

    function settings() {
        echo "<h1>Settings</h1>";

        if (isset($_POST["SettingsOptin"])) {
            if ($_POST["url"] != "") {
                update_post_meta("1", "FromUrlOptin", sanitize_text_field($_POST["url"]));
            }
        }
        $url = "";
        if (get_post_meta("1", "FromUrlOptin", true) != "") {
            $url = get_post_meta("1", "FromUrlOptin", true);
        }
        ?>
        <form action="" method="post">

            <div class="jeetCreateOptinLayout">
                <div class="fieldelementoptin">
                    <h4 style="margin-bottom:0;">Use this Shortcode on the page or post where you will Send the Form To Save Form Values</h4>
                    <input type="text" value="[leadGenerate_jeetOptin]" disabled>
                </div>
                <div class="clr"></div>
                <div class="fieldelementoptin">
                    <h4 style="margin-bottom:0;">Enter Post/Page Url Where you want to send the form(Eg. <?php echo home_url() ?>/postname)</h4>
                    <input type="text" value="<?php echo esc_attr($url); ?>" name="url" placeholder="Enter  Url" style="width: 80%;">
                </div>
                <div class="clr"></div>

            </div>
            <div>
                <input type="submit" name="SettingsOptin" value="save">
            </div>

        </form>
        <?php
    }

    function header_image_optin() {
        ?>
        <IMG SRC="<?php echo esc_url(optinjeet_pluginurl.'/images/msmall.png'); ?>" class="floatLeft">
        <?php
    }

    function footer_image_optin() {
        ?>

        <?php
    }
    
    

 
    
    



 function form_all_smtp_settings() {
        ?>
       <h1>All SMTP</h1>
      
       <div class="all-smtpsetting-panel"style="position: relative;
    width:75%;
    margin-bottom: 10px;
    padding-left: 215px;
    display: inline-block;
    background: #fff;
    border: 1px solid #E6E9ED;">
              <div class="panel-full-body" style="    padding: 0 5px 6px;
    position: relative;
    width: 100%;
    float: left;
    clear: both;
    margin-top: 5px;">
     <table border="1" width="80%;" cellpadding="10" cellspacing="5" style="margin-top:40px; margin-bottom: 30px;" >
       <tr>
        <th># </th>
        <th> SMTP Name</th>
        <th>Action</th>
       </tr>
      <tr>
       <td>1</td>
       <td>SMTP</td>
      <td> <a href="#">
          <span class="glyphicon glyphicon-edit"></span>         
           </a>
           <a href="#">
          <span class="glyphicon glyphicon-trash"></span>
        </a>
       </td>
     </tr>
     <tr>
       <td>#</td>
       <td>SMTP Name</td>
       <td>Action</td>
     </tr>
</table>
        
              </div>
                  
       </div>
       <?php
}

}
}