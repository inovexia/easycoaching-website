<?php
/* Template Name: Courses */ 
get_header();
?>

<?php
    defined('ACCESS_CODE') or define('ACCESS_CODE', 'EA202000001');
    defined('API_PATH') or define('API_PATH', 'https://icbtc.com/development/easylms/public/api');
    $api = 'courses';
    $api_attr = '';
    $request_path = API_PATH."/$api/".ACCESS_CODE."/$api_attr";
    $data = json_decode(file_get_contents($request_path), true);
    ?>

    <section class="py-5">
        <div class="container">
            <div class="row">
            <?php
                if($data['status'] && !empty($data['courses'])) {
            	    foreach ($data['courses'] as $i => $course) {
                        ?>
                <div class="col-12 col-md-6 col-lg-4 mb-5">
                    <div class="course-list">
                        <div class="position-relative course-image w-100 text-center">
                            
                            <a href="<?php echo site_url(). '/course?id=' . $course['course_id']; ?>">
                            <?php
                            $bg_img = $course['feat_img'];
                            if($bg_img !== ""){ 
                           echo '<img class="card-img-left" src="'.$bg_img.'">';
                            }
                            else{
                            echo '<img src="http://localhost/easycoaching/wp-content/uploads/2020/12/course-image.png">';
                            }
                            ?>
                            <span class="ribbon-text position-absolute">NEW</span>
                            </a>
                        </div>

                        <div class="align-items-center w-100 text-left">
                            <div class="card-body">
                                <a href="<?php echo site_url(). '/course?id=' . $course['course_id']; ?>">
                                    <h4 class="mb-2 text-dark">
                                        <?php echo $course['title']; ?>
                                    </h4>
                                </a>
                                <p class="listing-desc mb-3">
                                <?php echo isset($course['price'])?"<b>Cost:</b> &#8377; ".$course['price']:null; ?>
                        </p>
                        <p>  <?php echo $course['descriptionn']; ?>
                                         </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            	    }
                }
                ?>
            </div>
        </div>
    </section>


<?php get_footer(); ?>