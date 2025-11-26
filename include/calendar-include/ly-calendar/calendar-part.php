<!-- Update the Calendar by LY on 2024.9.11 -->
<style>
    .is_closeday {
        color: red !important;
    }
</style>

<div class="calendar_content">
    <h3><?php echo $captions[$month_key]; ?></h3>
    <div class="calendar-wrap">
        <figure class="calendar">
            <table class="calendar">
                <thead>
                    <tr>
                        <?php if (!empty($days_list)):
                            foreach ($days_list as $val) :
                        ?>
                                <th>
                                    <div <?php if($val['label'] == '⼟') { ?>style="color: #0000FF;"<?php } else if($val['label'] == '⽇') { ?>class="break"<?php } ?> ><?php echo $val['label']; ?></div>
                                </th>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($month_item)):
                        foreach ($month_item as $weekdays):
                    ?>
                            <tr class="">
                                <?php foreach ($weekdays as $val): ?>
                                    <?php
                                    $is_holiday            = date_filter($schedule_array, $val)['is_holiday'];
                                    $is_doctor_1            = date_filter($schedule_array, $val)['doctor_1'];
                                    $is_doctor_day = $is_doctor_1;
                                    ?>
                                    <td>
                                        <?php
                                        if ($val) {
                                        ?>
										<?php
											// 初期化
											if ($val) {
												$weekday = date('w', strtotime($val)); // 0:日, 6:土
											}
										?>
                                            <div <?php if($weekday == 6) { ?>style="color: #0000FF;"<?php } else if($weekday == 0) { ?>class="break"<?php } ?> >
                                                <?php
                                                echo date("j", strtotime($val));
                                                ?>
                                            </div>
                                            <?php
                                            if ($val):
                                            ?>
                                                <?php if ($is_doctor_day): ?>
                                                    <?php if ($is_doctor_1): ?>
                                                        <div class="tag doctor_item doctor_1">
                                                            <?php echo $is_doctor_1; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php if ($is_holiday): ?>
                                                        <div class="break">休診日</div>
                                                    <?php else: ?>
                                                        <div>
                                                            営業日
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        </figure>
    </div>
</div>