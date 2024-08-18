<div class="modal fade" id="modalEdit{{ $customer->customer_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modaleditLabel{{ $customer->customer_id }}" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('customer.update.post',$customer->customer_id)}}" method="POST">
          @csrf
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modaleditLabel{{ $customer->customer_id }}">{{ $titleEdit }}</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="floatingInputValue">Gmail</label>
                      <input type="email" class="form-control" id="usermail" name="email" placeholder="@gmail.com" value="{{ $customer->email }}"readonly>
                  </div>
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Tên</label>
                  <input type="text" class="form-control" id="customer_name" aria-describedby="emailHelp" name="customer_name" value="{{ $customer->customer_name }}">
              </div>
              <div class="mb-3">
                <label for="numberphone" class="form-label">Điện thoại</label>
                <input type="text" class="form-control" id="tel_num" name="tel_num" value="{{ $customer->tel_num }}">
            </div>
              <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <textarea name="address" id="address" cols="20" rows="3" class="form-control">{{ $customer->address }}</textarea>
            </div>
              <div class="mb-3 form-check">
                  <label class="form-check-label" for="exampleCheck1">Trạng thái</label>
                  <fieldset class="form-group row">
                    <div class="col-sm-10">
                      <div class="form-check">
                        <label class="form-check-label col-sm-3">
                          <input class="form-check-input radio-inline" type="radio" name="is_active" id="is_active" value="1" {{ ($customer->is_active == 1) ? 'checked' : null }}>Yes</label>
                          <label class="form-check-label">
                          <input class="form-check-input radio-inline" type="radio" name="is_active" id="is_active" value="2" {{ ($customer->is_active == 2) ? 'checked' : null }}>No</label>
                      </div>
                   </div>
                </fieldset>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary">Lưu</button>
          </div>
        </div>
      </div>
    </div>
</form>


