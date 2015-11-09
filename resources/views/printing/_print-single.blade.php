@foreach($members as $member)

    <table>
        <tr>
            <td>
                <p style="text-align: center;">
                    <img src="{{ url($member['photo']) }}" style="width: 95px;"/>
                </p>
                <p style="margin: 0; text-align: center;">{{ $member['name'] }}</p>
                <p style="margin: 0; text-align: center;">{{ $member['role'] }}</p>
            </td>
            <td>
                <ul class="text-center" style="list-style-type: none; font-size: 20px; font-weight: 800;">
                    @foreach($member['zone'] as $zone)
                        <li>{{ $zone['zone'] }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
    </table>
    <img src="{{ 'data:image/png;base64,' .DNS1D::getBarcodePNG($member['grade'][0]['number'], "C39") }}" style="width: 100%;">

@endforeach