<div class="tab-pane fade" id="list-razorpay" role="tabpanel" aria-labelledby="list-razorpay-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.razorpay-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>RazorPay Status</label>
                    <select id="" class="form-control" name="status">
                        <option {{ @$razorpaySetting->status === 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{ @$razorpaySetting->status === 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Country Name</label>
                    <select id="" class="form-control select2" name="country_name">
                        <option value="">Select</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{ $country === @$razorpaySetting->country_name ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Name</label>
                    <select id="" class="form-control select2" name="currency_name">
                        <option value="">Select</option>
                        @foreach (config('settings.currency_list') as $key => $currency)
                            <option {{ $key === @$razorpaySetting->currency_name ? 'selected' : '' }}
                                value="{{ $key }}">{{ $currency }} ({{ $key }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency rate (per {{ $settings->currency_name }})</label>
                    <input type="text" class="form-control" name="currency_rate"
                        value="{{ @$razorpaySetting->currency_rate }}">
                </div>
                <div class="form-group">
                    <label>RazorPay Key</label>
                    <input type="text" class="form-control" name="razorpay_key"
                        value="{{ @$razorpaySetting->razorpay_key }}">
                </div>
                <div class="form-group">
                    <label>RazorPay Secret Key</label>
                    <input type="text" class="form-control" name="razorpay_secret_key"
                        value="{{ @$razorpaySetting->razorpay_secret_key }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
