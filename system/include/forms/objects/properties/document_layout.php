
                               <!-- form edit doc layout -->
             <div class="form-group">
                    <label for="object_layout">Layout</label>
                    <select class="form-control" id="object_layout" name="object_layout">
                        <?php
                                            
                        $forms_props_layouts=$system_layouts;  
                          
                        foreach ($forms_props_layouts as $object_layout) {
                            if ($object->layout == $object_layout) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option value=\"".$object_layout."\"" . $selected . ">" . $object_layout . "</option>";
                        }
                        
                  
                        ?>
                    </select>
                </div> 