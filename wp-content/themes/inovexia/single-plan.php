<?php get_header(); 
$id = get_the_ID();
setup_postdata($id);
?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-9 mb-5">
                <div class="card">
                    <div class="card-header">
                      <h1 class="text-display-1 m-0"><?php the_title(); ?></h1>
                    </div>
                    <div class="card-body">
                        <?php the_content(); ?>
                        <div class="d-flex justify-content-between">
                            <div class="price my-auto">
                                Price:
                                <?php
                                    $price = get_field('price');
                                    $tests = get_field('tests');
                                    if ($price == '' || $price == 0){
                                        $price = "Free";
                                    } else {
                                        $price = '<i class="fa fa-rupee-sign"></i> '.$price.' per month';
                                    }
                                    echo $price;
                                ?>
                            </div>
                            <div class="tests my-auto">
                                <span class="label bg-amber-400">
                                    <?php
                                        echo 'Tests: <span class="label label-warning">'.$tests.'+</span>';
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-lg paper-shadow add2cart" data-id="<?php the_field('plan_id', get_the_ID()); ?>" data-price="<?php the_field('price', get_the_ID()); ?>" data-title="<?php the_title(); ?>" data-desc="<?php echo strip_tags(get_the_excerpt()); ?>" href="javascript:void(0);"><i class="fa fa-cart-plus"></i> Add to Cart</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-5">
				<?php dynamic_sidebar('sidebar-right'); ?>
			</div>
        </div>
    </div>
</div>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>