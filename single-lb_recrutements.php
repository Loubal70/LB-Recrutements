<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	get_header();
        
?>

<main>

<div class="container"> 

    <section class="recrutement-single">
        <div class="recrutement-single__content">
            <div class="recrutement-single__content__top">
                <h2><?php the_title(); ?></h2>
                <h3><?= timeago(get_the_date('Y-m-d H:m:s')) ?></h3>
            </div>
        
            <?php the_content(); ?>
        </div>
    </section>
    

</div>

<?php get_footer(); ?>