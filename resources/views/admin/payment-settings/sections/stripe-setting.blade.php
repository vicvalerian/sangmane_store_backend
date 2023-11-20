<div class="tab-pane fade" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.stripe-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Stripe Status</label>
                    <select id="" class="form-control" name="status">
                        <option {{ @$stripeSetting->status === 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{ @$stripeSetting->status === 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Account Mode</label>
                    <select id="" class="form-control" name="mode">
                        <option {{ @$stripeSetting->mode === 0 ? 'selected' : '' }} value="0">Sandbox</option>
                        <option {{ @$stripeSetting->mode === 1 ? 'selected' : '' }} value="1">Live</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Country Name</label>
                    <select id="" class="form-control select2" name="country_name">
                        <option value="">Select</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{ $country === @$stripeSetting->country_name ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Name</label>
                    <select id="" class="form-control select2" name="currency_name">
                        <option value="">Select</option>
                        @foreach (config('settings.currency_list') as $key => $currency)
                            <option {{ $key === @$stripeSetting->currency_name ? 'selected' : '' }}
                                value="{{ $key }}">{{ $currency }} ({{ $key }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency rate (per {{ $settings->currency_name }})</label>
                    <input type="text" class="form-control" name="currency_rate"
                        value="{{ @$stripeSetting->currency_rate }}">
                </div>
                <div class="form-group">
                    <label>Stripe Client ID</label>
                    <input type="text" class="form-control" name="client_id"
                        value="{{ @$stripeSetting->client_id }}">
                </div>
                <div class="form-group">
                    <label>Stripe Secret Key</label>
                    <input type="text" class="form-control" name="secret_key"
                        value="{{ @$stripeSetting->secret_key }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
