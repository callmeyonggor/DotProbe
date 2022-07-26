<body>
    <div class="container-fluid">
        <a href="/">
            <p class="fs-1"><i class="fa-solid fa-angle-left"></i> Go Back</p>
        </a>
        <div class="table-responsive">
            <table class="fs-2 table table-bordered">
                <tr>
                    <th>
                        Total_correct
                    </th>
                    <td>
                        {{ $total_correct }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Average Response Time
                    </th>
                    <td>
                        {{$avg_response}}ms
                    </td>
                </tr>
                <tr>
                    <th>
                        Total Incongruent
                    </th>
                    <td>
                        {{$total_incongruents}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Average Incongruent Response Time
                    </th>
                    <td>
                        {{$avg_incongruent_response}}ms
                    </td>
                </tr>
                <tr>
                    <th>
                        Total Congruent
                    </th>
                    <td>
                        {{$total_congruents}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Average Congruent Response Time
                    </th>
                    <td>
                        {{$avg_congruent_response}}ms
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>