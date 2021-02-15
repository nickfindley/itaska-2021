<?php
function dutchtown_poll_results(
    $poll_category,
    $poll_result_style = 'bar',
    $poll_result_max_results = 10
)
{
    $poll_responses = new WP_Query(
        array(
            'post_type' => 'poll_response',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'poll_category',
                    'terms' => sanitize_title( $poll_category ),
                    'field' => 'slug'
                )
            )
        )
    );

    if ( $poll_responses->have_posts() ) :
        while ( $poll_responses->have_posts() ) :
            $poll_responses->the_post();
            if ( have_rows( 'poll_answer', get_the_ID() )) :
                while ( have_rows( 'poll_answer', get_the_ID() ) ) :
                    the_row();
                    $answers[] = string_to_uc( get_sub_field( 'answer', get_the_ID() ) );
                endwhile;
            endif;
        endwhile;
        wp_reset_postdata();
    endif;

    if ( ! empty( $answers ) ):
        $answers = array_filter( $answers );
    endif;

    if ( ! empty( $answers ) ):
        $result = array();

        foreach ( $answers as $val ) :
            if ( ! isset( $result[$val] ) ) : // Check if the index exists
                $result[$val] = array();
            endif;
            $result[$val][] = $val;
        endforeach;

        foreach ( $result as $key => $value ) :
            $result[$key] = count( $value );
        endforeach;
        array_multisort(array_values($result), SORT_DESC, array_keys($result), SORT_ASC, $result);

        $output = '
            <h2>Poll Responses: ' . $poll_category . '</h2>
            <div class="chart-container center" style="position: relative; width: 100%; max-height: 70vh;">
                <canvas id="' . camel_case( $poll_category ) . '"></canvas>
            </div>';

        $output .= '<script>';
        $output .= "
            var pollTest = document.getElementById('" . camel_case( $poll_category ) . "');
            Chart.defaults.global.defaultFontFamily = 'Avenir, \"Avenir Next\", AvenirNext, sans-serif';
            var myChart = new Chart(" . camel_case( $poll_category ) . ", {
                type: '". $poll_result_style . "',
                data: {
                    labels: [";

            $count = 0; $other = 0;
            foreach ( $result as $key => $value ) :
                $count++;
                if ( $count > $poll_result_max_results ) :
                    $other++;
                else :
                    $output .= "
                        '" . $key . "',\r";
                endif;
            endforeach;

        if ( $other !== 0 ) :
            $output .= "
                        'Other'],";
        else :
            $output .= "
                        ],";
        endif;

        $output .=  "     
                    datasets: [{
                        data: [";

            $count = 0; $other = 0;
            foreach ($result as $key => $value ) :
                $count++;
                if ( $count > $poll_result_max_results ) :
                    $other++;
                else :
                    $output .= "
                            '" . $value . "',\r";
                endif;
            endforeach;

        $output .=
                            "\n\t\t\t\t\t\t\t'" . $other . "'
                        ],";

        if (
            $poll_result_style == 'bar' ||
            $poll_result_style == 'horizontalBar' ||
            $poll_result_style == 'line'
        ) :
            $output .= "backgroundColor: '#fce409'";

        elseif (
            $poll_result_style == 'pie' ||
            $poll_result_style == 'doughnut'
        ) :
            $output .= "
                        backgroundColor: [
                            'rgba(252, 228, 9, 1)',
                            'rgba(229, 206, 0, 1)',
                            'rgba(204, 183, 0, 1)',
                            'rgba(178, 160, 0, 1)',
                            'rgba(153, 137, 0, 1)',
                            'rgba(127, 114, 0, 1)',
                            'rgba(102, 91, 0, 1)',
                            'rgba(76, 68, 0, 1)',
                            'rgba(51, 45, 0, 1)',
                            'rgba(25, 22, 0, 1)',
                            'rgba(0, 0, 0, 1)',
                            'rgba(255, 234, 51, 1)',
                            'rgba(229, 211, 51, 1)',
                            'rgba(204, 188, 51, 1)',
                            'rgba(178, 165, 51, 1)',
                            'rgba(153, 142, 51, 1)',
                            'rgba(127, 119, 51, 1)',
                            'rgba(102, 96, 51, 1)',
                            'rgba(76, 73, 51, 1)',
                            'rgba(51, 51, 51, 1)',
                            'rgba(255, 242, 127, 1)'
                        ],";
            
            $output .= "
                        hoverBackgroundColor: [               
                            'rgba(252, 228, 9, .75)',
                            'rgba(229, 206, 0, .75)',
                            'rgba(204, 183, 0, .75)',
                            'rgba(178, 160, 0, .75)',
                            'rgba(153, 137, 0, .75)',
                            'rgba(127, 114, 0, .75)',
                            'rgba(102, 91, 0, .75)',
                            'rgba(76, 68, 0, .75)',
                            'rgba(51, 45, 0, .75)',
                            'rgba(25, 22, 0, .75)',
                            'rgba(0, 0, 0, .75)',
                            'rgba(255, 234, 51, .75)',
                            'rgba(229, 211, 51, .75)',
                            'rgba(204, 188, 51, .75)',
                            'rgba(178, 165, 51, .75)',
                            'rgba(153, 142, 51, .75)',
                            'rgba(127, 119, 51, .75)',
                            'rgba(102, 96, 51, .75)',
                            'rgba(76, 73, 51, .75)',
                            'rgba(51, 51, 51, .75)',
                            'rgba(255, 242, 127, 1)'
                        ]";
        endif;

        $output .= "
                    }],
                }, 
                options: {";
        
        if (
            $poll_result_style == 'bar' ||
            $poll_result_style == 'horizontalBar' ||
            $poll_result_style == 'line'
        ) :
            $output .= "
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                min: 0,
                                stepSize: 1
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                stepSize: 1
                            }
                        }]
                    }";
        elseif (
            $poll_result_style == 'pie' ||
            $poll_result_style == 'doughnut'
        ) :
            $output .= "
                    legend: {
                        display: true,
                        align: 'start',
                        position: 'left'
                    }";
        endif;

        $output .= "
                }
            });
        </script>";
    
        echo $output;
    endif;
}