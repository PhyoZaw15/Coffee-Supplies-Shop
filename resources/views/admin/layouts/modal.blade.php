<!-- Delete Form Start -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h4 class="modal-title">Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="#" method="post" id="deleteModalFormAction">
                {{ method_field("delete") }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">Are you sure ? </p>
                    <p  class="text-center">You want to delete this data.!&hellip;</p>
                    <input type="hidden" name="id" id="delete_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-outline-light">Yes</button>
                </div>
            </form>
        </div>
    </div>
  </div>
  <!-- End Delete Form -->
