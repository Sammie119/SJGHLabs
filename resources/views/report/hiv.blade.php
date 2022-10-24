<table>
    <caption>RECORD OF HIV POSITIVES</caption>
    <tr>
        <th>#</th>
        <th>OPD No</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Result</th>
    </tr>
    {{-- {{ dd($query['hiv_final_pos']) }} --}}
    @if (!empty($query['hiv_final_pos']))
        @foreach ($query['hiv_final_pos'] as $key => $hiv)
            <tr>
                <td style="text-align: center">{{ ++$key }}</td>
                <td style="text-align: left; padding-left: 20px;">{{ $hiv->opd_number }}</td>
                <td style="text-align: left; padding-left: 20px;">{{ $hiv->name }}</td>
                <td style="text-align: center">{{ $hiv->age }}</td>
                <td style="text-align: center">{{ $hiv->gender }}</td>
                <td style="text-align: center">{{ $hiv->hiv_final }}</td>
            </tr> 
        @endforeach
    @endif

    @if (!empty($query['sd_bioline_pos']))
        @foreach ($query['sd_bioline_pos'] as $key => $hiv)
            <tr>
                <td style="text-align: center">{{ ++$key }}</td>
                <td style="text-align: left; padding-left: 20px;">{{ $hiv->opd_number }}</td>
                <td style="text-align: left; padding-left: 20px;">{{ $hiv->name }}</td>
                <td style="text-align: center">{{ $hiv->age }}</td>
                <td style="text-align: center">{{ $hiv->gender }}</td>
                <td style="text-align: center">{{ $hiv->sd_bioline }}</td>
            </tr> 
        @endforeach
    @endif                
</table>
 <br>
<br>

<table>
    <caption>RECORD OF HIV NEGATIVE</caption>
    <tr>
        <th>#</th>
        <th>OPD No</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Result</th>
    </tr>

    @if (!empty($query['hiv_final_neg']))
        @foreach ($query['hiv_final_neg'] as $key => $hiv)
            <tr>
                <td style="text-align: center">{{ ++$key }}</td>
                <td style="text-align: left; padding-left: 20px;">{{ $hiv->opd_number }}</td>
                <td style="text-align: left; padding-left: 20px;">{{ $hiv->name }}</td>
                <td style="text-align: center">{{ $hiv->age }}</td>
                <td style="text-align: center">{{ $hiv->gender }}</td>
                <td style="text-align: center">{{ $hiv->hiv_final }}</td>
            </tr> 
        @endforeach
    @endif

    @if (!empty($query['sd_bioline_neg']))
        @foreach ($query['sd_bioline_neg'] as $key => $hiv)
            <tr>
                <td style="text-align: center">{{ ++$key }}</td>
                <td style="text-align: left; padding-left: 20px;">{{ $hiv->opd_number }}</td>
                <td style="text-align: left; padding-left: 20px;">{{ $hiv->name }}</td>
                <td style="text-align: center">{{ $hiv->age }}</td>
                <td style="text-align: center">{{ $hiv->gender }}</td>
                <td style="text-align: center">{{ $hiv->sd_bioline }}</td>
            </tr> 
        @endforeach
    @endif

</table>