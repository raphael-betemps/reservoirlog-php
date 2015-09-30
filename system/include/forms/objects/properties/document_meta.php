    <!-- form edit meta -->
           <div class="form-group">
                <label for="object_meta">Document meta description</label>
                <input type="text" class="form-control" id="object_meta" name="object_meta[description]" value="<?php echo $object->meta["description"]; ?>">
            </div>
            <div class="form-group">
                <label for="object_meta">Document meta keywords</label>
                <input type="text" class="form-control" id="object_meta" name="object_meta[keywords]" value="<?php echo $object->meta["keywords"]; ?>">
            </div>
            <div class="form-group">
                <label for="object_meta">Document meta author</label>
                <input type="text" class="form-control" id="object_meta" name="object_meta[author]" value="<?php echo $object->meta["author"]; ?>">
            </div>