

<!-- form edit Document header -->
            <div class="form-group">
                <label for="object_document_header"><?php echo $object->type; ?>  header</label>
                <textarea class="form-control" id="object_description" name="object_document_header"  rows="3"><?php echo $object->getDocumentHeader() ; ?></textarea>
            </div>