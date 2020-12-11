<?php
/* Template Name: Course */ 
get_header();
?>
 <?php
defined('ACCESS_CODE') or define('ACCESS_CODE', 'EA202000001');
defined('API_PATH') or define('API_PATH', 'https://icbtc.com/development/easylms/public/api');
$api = 'course';
$api_attr = isset($_GET['id'])?$_GET['id']:null;
$request_path = API_PATH."/$api/".ACCESS_CODE."/$api_attr";
$data = json_decode(file_get_contents($request_path), true);
if($data['status'] && !empty($data['course'])):
	extract($data['course']);
?>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
			<div class="single-course-content">
            
	<img src="<?php echo $feat_img; ?>" alt="<?php echo $title; ?>" />
	<h1 class="pt-3"><?php echo $title; ?></h1>
	<h2><?php echo isset($price)?"<b>Cost:</b> &#8377; ".$price:null; ?></h2>
	
	
</div>
<div class="tab-data mt-3">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#description">Description</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#curriculum">Curriculum</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#lessons">Lessons</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#additional">Additional</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content pt-3">
  <div class="tab-pane container active" id="description">
  <?php echo $description; ?>
  </div>
  <div class="tab-pane container fade" id="curriculum">
  <?php echo $curriculum; ?>
  </div>
  <div class="tab-pane container fade" id="lessons">
  <?php if(!empty($lessons)): ?>
		<ul>
		<?php foreach($lessons as $i => $lesson): ?>
			<?php if($lesson['status']): ?>
			<li style="padding: 1rem 0;">
				<h4 style="margin: 0;"><?php echo $lesson['title']; ?></h4>
				<h5 style="margin: 0;"><?php echo $lesson['lesson_key']; ?></h5>
			</li>
			<?php endif;?>
		<?php endforeach;?>
		</ul>
	<?php endif;?>
  </div>
  <div class="tab-pane container fade" id="additional">
  
	<?php if(!empty($tests)): ?>
		<h3>Tests</h3>
		<ul>
		<?php foreach($tests as $i => $test): ?>
			<?php if($test['finalized']): ?>
			<li style="padding: 1rem 0;">
				<h4 style="margin: 0;"><?php echo $test['title']; ?></h4>
				<h5 style="margin: 0;"><?php echo $test['unique_test_id']; ?></h5>
			</li>
			<?php endif;?>
		<?php endforeach;?>
		</ul>
	<?php endif;?>

	<?php if(!empty($batches)): ?>
		<h3>Batches</h3>
		<ul>
		<?php foreach($batches as $i => $batch): ?>
			<?php if($batch['status']): ?>
			<li style="padding: 1rem 0;">
				<h4 style="margin: 0;"><?php echo $batch['batch_name']; ?></h4>
				<p style="margin: 0;"><?php echo isset($batch['start_date'])? "Start At: ". date('d-m-Y H:m', $batch['start_date']):null; ?></p>
				<p style="margin: 0;"><?php echo isset($batch['end_date'])? "End At: ". date('d-m-Y H:m', $batch['end_date']):null; ?></p>
			</li>
			<?php endif;?>
		<?php endforeach;?>
		</ul>
	<?php endif;?>
	
	<?php if(!empty($teachers)): ?>
		<h3>Teachers</h3>
		<ul>
		<?php foreach($teachers as $i => $teacher): ?>
			<?php if($teacher['status']): ?>
			<li style="padding: 1rem 0;">
				<h4 style="margin: 0;"><?php echo $teacher['first_name'] . " " . $teacher['last_name']; ?></h4>
				<h5 style="margin: 0;"><?php echo isset($teacher['email'])?$teacher['email']:null; ?></h5>
			</li>
			<?php endif;?>
		<?php endforeach;?>
		</ul>
	<?php endif;?>
<?php endif;?>
  </div>
</div>
</div>
            </div>
            <div class="col-12 col-md-4">
			<div class="card card-default shadow-sm p-4">
                        <?php dynamic_sidebar('sidebar-right'); ?>
                    </div>
            </div>
        </div>
    </div>
</section>
	


<?php get_footer(); ?>