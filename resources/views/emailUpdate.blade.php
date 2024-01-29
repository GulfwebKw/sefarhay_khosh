<table style="width: 100%;border: none;">
    <tr>
        <td colspan="2" style="border: none;text-align: center;padding-top: 20px;">
            <strong>{{ \HackerESQ\Settings\Facades\Settings::get('site_title_en') }}</strong>
        </td>
    </tr>
    <tr>
        <td style="width: 80%;border: none;vertical-align: middle;padding: 20px 20px;">
            Dear User,
            <div style="margin-top:10px;"></div>
            Your application status has been updated to <strong>{{ $application->status->title_en }}</strong>. you can visit it from:<br>
            <a href="{{ route('application.show' , ['uuid' => $application->uuid])  }}">
                {{ route('application.show' , ['uuid' => $application->uuid])  }}
            </a>
            <div style="margin-top:10px;"></div>
            You can also view application information below the email and attachments.
        </td>
        <td style="width: 20%;border: none; text-align: right;padding: 10px;">
            @if(\HackerESQ\Settings\Facades\Settings::get('logo'))
            <img style="max-width: 100%;" src="{{ asset(Str::replaceFirst('public/' , 'storage/' , \HackerESQ\Settings\Facades\Settings::get('logo'))) }}"/>
            @endif
        </td>
    </tr>
</table>
<table style="width: 100%;border: none;">
    <tr>
        <td>
            <strong>Gateway</strong>: {{ $application->gateway }}
        </td>
        <td>
            <strong>Status</strong>: {{ $application->status->title_en }}
        </td>
    </tr>
    <tr>
        <td>
            <strong>Paid at</strong>: {{ $application->paid_at }}
        </td>
        <td>
            <strong>Price</strong>: {{ number_format($application->price) }}
        </td>
    </tr>
    <tr>
        <td>
            <strong>Invoice Reference</strong>: {{ $application->invoiceReference }}
        </td>
        <td>
            <strong>Invoice Id</strong>: {{ $application->invoiceId }}
        </td>
    </tr>
    <tr>
        <td>
            <strong>Name</strong>: {{ $application->name }}
        </td>
        <td>
            <strong>Phone</strong>: {{ $application->phone }}
        </td>
    </tr>
    <tr>
        <td>
            <strong>Email</strong>: {{ $application->email }}
        </td>
        <td>
            <strong>Country</strong>: {{ $application->country->title_en }}
        </td>
    </tr>
</table>
