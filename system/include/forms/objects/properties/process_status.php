      <!-- form edit process status -->
             <div class="form-group">
                    <label for="object_status">Process status ("core" is not shown in menus)</label>
                    <select class="form-control" id="object_status" name="object_status">
                        <?php
                        
                        foreach ($system_data_process_status as $object_status) {
                            if ($object->status == $object_status) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option value=\"".$object_status."\"" . $selected . ">" . $object_status . "</option>";
                        }
                        ?>
                    </select>
                </div>