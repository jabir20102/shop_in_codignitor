<div id="discountModale" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="discount_form">
                <div class="modal-header">
                   <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                   <h4 class="modal-title">Set Offer</h4>
                </div>
                <div class="modal-body">
                   
                    <div class="form-group">
                        <label for="percent">Choose Discount</label>
                        <select id="percent" name="percent">
                            <option value="0.1">10%</option>
                            <option value="0.2">20%</option>
                            <option value="0.3">30%</option>
                            <option value="0.4">40%</option>
                            <option value="0.5">50%</option>
                        </select>
                    </div>
                    <input type="hidden" name="id" id="product_id">
                </div>
                <div class="modal-footer">
                    <input type="submit" name="submit"  value="Add" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>