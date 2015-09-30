
                            
                                               <!-- form edit doc style -->
             <div class="form-group">
                    <label for="object_style">Style</label>
                    <select class="form-control" id="object_style" name="object_style">
                        <?php
                                            
                        $forms_props_styles=$system_styles;  
                          
                        foreach ($forms_props_styles as $object_style) {
                            if ($object->style == $object_style) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option value=\"".$object_style."\"" . $selected . ">" . $object_style . "</option>";
                        }
                        
                  
                        ?>
                    </select>
                </div> 