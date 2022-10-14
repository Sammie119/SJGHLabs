<table style="break-inside: avoid;">
    <caption>RECORD OF BLOOD DONATIONS AND TRANSFUSIONS</caption>
    <tr>
        <td colspan="3" style="text-align:start; font-size: 20px;"><b>BLOOD DONATIONS</b></td>
    </tr>
    <tr>
        <td rowspan="2" style="padding-right: 25%">ANTI TPHA/VDRL</td>
        <td style="padding-right: 25%">POSITIVE</td>
        <td>{{ $query['bloodbank']->anti_tpha_pos }}</td>
    </tr>
    <tr>                        
        <td style="padding-right: 25%">TOTAL</td>
        <td>{{ $query['bloodbank']->anti_tpha }}</td>
    </tr>

    <tr>
        <td rowspan="2" style="padding-right: 25%">HBsAg</td>
        <td style="padding-right: 25%">POSITIVE</td>
        <td>{{ $query['bloodbank']->hbs_ag_pos }}</td>
    </tr>
    <tr>
        <td style="padding-right: 25%">TOTAL</td>
        <td>{{ $query['bloodbank']->hbs_ag }}</td>
    </tr>

    <tr>
        <td rowspan="2" style="padding-right: 25%">HCV</td>
        <td style="padding-right: 25%">POSITIVE</td>
        <td>{{ $query['bloodbank']->hcv_pos }}</td>
    </tr>
    <tr>
        <td style="padding-right: 25%">TOTAL</td>
        <td>{{ $query['bloodbank']->hcv }}</td>
    </tr>

    <tr>
        <td style="padding-right: 25%">BLOOD GROUP</td>
        <td style="padding-right: 25%">TOTAL</td>
        <td>{{ $query['bloodbank']->blood }}</td>
    </tr>
    <tr>
        <td rowspan="2" style="padding-right: 25%">HIV</td>
        <td style="padding-right: 25%">REACTIVE</td>
        <td>{{ $query['bloodbank']->retro_pos }}</td>
    </tr>
    <tr>
        <td style="padding-right: 25%">TOTAL</td>
        <td>{{ $query['bloodbank']->retro }}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:start; font-size: 20px;"><b>BLOOD TRANSFUSIONS</b></td>
    </tr>
    <tr>
        <td rowspan="13" style="text-align:center; font-size: 20px;"><b>WARDS</b></td>
    </tr>
    <tr>
        <td style="padding-right: 25%">Emergency</td>
        <td>{{ $query['blood_transfus']->emerg }}</td>
    </tr>
    <tr>
        <td style="padding-right: 25%">Maternity Ward</td>
        <td>{{ $query['blood_transfus']->maternity }}</td>
    </tr>
    <tr>
        <td style="padding-right: 25%">General Ward</td>
        <td>{{ $query['blood_transfus']->general }}</td>
    </tr>
    <tr>
        <td style="padding-right: 25%">Orthopaedic Ward</td>
        <td>{{ $query['blood_transfus']->orthopaedic }}</td>
    </tr>
    <tr>
        <td style="padding-right: 25%">Childrens Ward</td>
        <td>{{ $query['blood_transfus']->childrens }}</td>
    </tr>
    <tr>
        <td style="padding-right: 25%"><b>TOTAL</b></td>
        <td><b>{{ $query['blood_transfus']->total }}</b></td>
    </tr>
    <tr>
        <td style="padding-right: 25%">ADULT MALES</td>
        <td>{{ $query['blood_transfus']->adult_male }}</td>
    </tr>
    <tr>
        <td style="padding-right: 25%">ADULT FEMALES</td>
        <td>{{ $query['blood_transfus']->adult_female }}</td>
    </tr>
    <tr>
        <td style="padding-right: 25%">MALE CHILDREN</td>
        <td>{{ $query['blood_transfus']->child_male }}</td>
    </tr>
    <tr>
        <td style="padding-right: 25%">FEMALE CHILDREN</td>
        <td>{{ $query['blood_transfus']->adult_female }}</td>
    </tr>
    <tr>
        <td style="padding-right: 25%"><b>TOTAL</b></td>
        <td><b>{{ $query['blood_transfus']->total }}</b></td>
    </tr>

</table>
<br>
<br>
<br>
<table>
    <caption>ATTENDANCE</caption>
    <tr>
        <td style="width: 50%; padding-right: 25%; font-size: 20px;">Male</td>
        <td style="padding-right: 25%; font-size: 20px;">{{ $query['attendance']->male }}</td>
    </tr>
    <tr>
        <td style="width: 50%; padding-right: 25%; font-size: 20px;">Female</td>
        <td style="padding-right: 25%; font-size: 20px;">{{ $query['attendance']->female }}</td>
    </tr>
    <tr>
        <td style="width: 50%; padding-right: 25%; font-size: 20px;">OPD</td>
        <td style="padding-right: 25%; font-size: 20px;">{{ $query['attendance']->opd }}</td>
    </tr>
    <tr>
        <td style="width: 50%; padding-right: 25%; font-size: 20px;">IPD</td>
        <td style="padding-right: 25%; font-size: 20px;">{{ $query['attendance']->ipd }}</td>
    </tr>
    <tr>
        <td style="width: 50%; padding-right: 25%; font-size: 20px;">Blood Donation</td>
        <td style="padding-right: 25%; font-size: 20px;">{{ $query['attendance']->blood_donors }}</td>
    </tr>
    <tr>
        <td style="width: 50%; padding-right: 25%; font-size: 20px;">Total Attendance</td>
        <td style="padding-right: 25%; font-size: 20px;">{{ $query['attendance']->total }}</td>
    </tr>
</table>