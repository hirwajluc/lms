<div class="modal fade lead-modal" id="lead-modal" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content data">
            <div class="modal-header modal-header-image mb-3">
                <h5 class="modal-title">{{ @$data['title'] }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3 d-flex justify-content-center">
                    <div class="col-xl-12 col-md-6 mb-3">
                        <label for="status_id" class="form-label">{{ ___('common.Course Title') }}</label>
                        <span>
                            <h5 class="text-15">{{ @$data['order_item']->course->title }}</h5>
                        </span>
                    </div>
                    <div class="col-xl-12 col-md-6 mb-3">
                        <label for="status_id" class="form-label">{{ ___('common.Payment Method') }}</label>
                        <span>
                            <h5 class="text-15">{{ @$data['order_item']->order->payment_method }}</h5>
                        </span>
                    </div>
                    <div class="col-xl-12 col-md-6 mb-3">
                        <label for="status_id" class="form-label">{{ ___('common.Invoice No') }}</label>
                        <span>
                            <h5 class="text-15">{{ @$data['order_item']->order->invoice_number }}</h5>
                        </span>
                    </div>
                    @if(@$data['order_item']->order->payment_method === 'offline')
                    <div class="col-xl-12 col-md-6 mb-3">
                        <label for="status_id" class="form-label">{{ ___('common.Payment Type') }}</label>
                        <span>
                            <h5 class="text-15">{{ @$data['order_item']->order->payment_manual['payment_type'] }}</h5>
                        </span>
                    </div>
                    <div class="col-xl-12 col-md-6 mb-3">
                        <label for="status_id" class="form-label">{{ ___('common.Additional Details') }}</label>
                        <span>
                            <h5 class="text-15">{{ @$data['order_item']->order->payment_manual['additional_details'] }}</h5>
                        </span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('backend/assets/js/modal/__modal.min.js') }}"></script>
