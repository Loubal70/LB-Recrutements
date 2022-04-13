<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	get_header();
?>

<main class="recrutement">

    <?php 
        if ( have_posts() ): 
            $type_de_poste      = get_field('type_de_poste');
            $temps_de_travail   = get_field('temps_de_travail');
            $competences        = get_field('competences');
            $nbr_postes         = $wp_query->post_count;
    ?>

        <section class="recrutement__header container">
            <div class="recrutement__header__title">
                <h1>Recrutement</h1>
                <span> 
                    Emploi<?= ($nbr_postes >= 2) ? 's' : '' ?> disponible : <span class="nbr"><?= $nbr_postes ?></span>
                </span>
            </div>
        </section>

        <section class="container">

        <ul class="recrutement__list" id="jobs_available">

            <?php while ( have_posts() ): the_post(); ?>
                <li class="recrutement__list__element">

                    <div class="recrutement__list__element__top">
                        <?php if ( has_post_thumbnail() ): ?>
                            <?php the_post_thumbnail() ?>
                        <?php endif; ?>
                        <?= timeago(get_the_date('Y-m-d H:m:s')) ?>
                    </div>

                    <div class="recrutement__list__element__bottom">
                        <h3 class="recrutement__list__element__bottom__title">
                            <?php the_title(); ?>
                        </h3>
                        <div class="recrutement__list__element__bottom__category">
                            <span><?= $type_de_poste ?></span>
                            <?php if($temps_de_travail === "tps_partiel"): ?>
                                <span>Temps partiel</span>
                                <?php else: ?>
                                    <span>Temps plein</span>
                            <?php endif; ?>
                            <?php if(!empty($competences)) : ?>
                                <span><?= $competences ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if ( has_excerpt() ): ?>
                            <?php the_excerpt(); ?>
                        <?php endif; ?>

                        <a href="<?php the_permalink(); ?>" class="recrutement__list__element__bottom__button">Voir l'offre</a>
                    </div>

                </li>
            <?php endwhile; ?>
            
        </ul>
    </section>
    <?php endif; ?>

<?php get_footer(); ?>