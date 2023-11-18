<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.paypal-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Paypal Status</label>
                    <select id="" class="form-control" name="status">
                        <option {{ @$paypalSetting->status === 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{ @$paypalSetting->status === 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Account Mode</label>
                    <select id="" class="form-control" name="mode">
                        <option {{ @$paypalSetting->mode === 0 ? 'selected' : '' }} value="0">Sandbox</option>
                        <option {{ @$paypalSetting->mode === 1 ? 'selected' : '' }} value="1">Live</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Country Name</label>
                    <select id="" class="form-control select2" name="country_name">
                        <option value="">Select</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{ $country === @$paypalSetting->country_name ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Name</label>
                    <select id="" class="form-control select2" name="currency_name">
                        <option value="">Select</option>
                        @foreach (config('settings.currency_list') as $key => $currency)
                            <option {{ $key === @$paypalSetting->currency_name ? 'selected' : '' }}
                                value="{{ $key }}">{{ $currency }} ({{ $key }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency rate (per USD)</label>
                    <input type="text" class="form-control" name="currency_rate"
                        value="{{ @$paypalSetting->currency_rate }}">
                </div>
                <div class="form-group">
                    <label>Paypal Client ID</label>
                    <input type="text" class="form-control" name="client_id"
                        value="{{ @$paypalSetting->client_id }}">
                </div>
                <div class="form-group">
                    <label>Paypal Secret Key</label>
                    <input type="text" class="form-control" name="secret_key"
                        value="{{ @$paypalSetting->secret_key }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
