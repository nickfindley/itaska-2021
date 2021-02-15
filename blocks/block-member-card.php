<?php  
    $photo_class = '';
    if ( get_field( 'member_photo' ) ) :
        $photo_class = ' card-has-photo';
    endif;
?>
<div class="card-wrapper">
    <div class="card<?php echo $photo_class; ?>">
        <?php
            if ( get_field( 'member_photo' ) ) :
                $image = get_field( 'member_photo' );
                echo wp_get_attachment_image( $image, 'xs', false, array( 'class' => 'card-img-top' ) );
            endif;
        ?>
        <div class="card-body">
            <h3 class="card-title">
            <?php
                echo get_field( 'member_first_name' ) . ' ' . get_field( 'member_last_name' );
            ?>
            </h3>
            <p class="card-text">
            <?php
                if ( get_field( 'member_title' ) ) :
            ?>
                    <span class="member-title"><?php the_field( 'member_title' ); ?></span>
            <?php
                endif;
                
                if ( get_field( 'member_title' ) && get_field( 'member_organization' ) ) :
            ?>
                <br>
            <?php
                endif;

                if ( get_field( 'member_organization' ) ) :
                    if ( get_field( 'member_organization_link' ) ) :
            ?>
                <a href="<?php the_field( 'member_organization_link' ); ?>"><?php the_field( 'member_organization' ); ?></a>
            <?php
                    else :
            ?>
                <?php the_field( 'member_organization' ); ?>
            <?php
                    endif;
                endif;
            ?>
            </p>
        </div>
        <?php
            if ( get_field( 'member_bio' ) ) :
        ?>
        <div class="card-footer">
            <a href="<?php the_field( 'member_bio' ); ?>">Read <?php the_field( 'member_first_name' ); ?>&rsquo;s bio</a>
        </div>
        <?php
            endif;
        ?>
    </div>
</div>