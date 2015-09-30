

            <!-- form edit Document level -->
             <div class="form-group">
                    <label for="object_level">Document level</label>
                    <select class="form-control" id="object_level" name="object_level">
                        <?php
                      
                        foreach ($system_data_levels as $object_level) {
                            if ($object->level == $object_level) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option value=\"".$object_level."\"" . $selected . ">" . $object_level . "</option>";
                        }
                        ?>
                    </select>
                </div>