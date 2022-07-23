<body>
    <div class="container-fluid">
        <div class="position-absolute top-50 start-50 translate-middle">
            <a href="/">
                <p class="fs-1"><i class="fa-solid fa-angle-left"></i> Go Back</p>
            </a>
            <p class="fs-3">Total_correct: {{$total_correct}}
                Average Response Time: {{$avg_response}}ms<br>
                Total Incongruent: {{$total_incongruents}}<br>
                Average Incongruent Response Time: {{$avg_incongruent_response}}ms<br>
                Total Congruent: {{$total_congruents}}<br>
                Average Congruent Response Time: {{$avg_congruent_response}}ms<br>
        </div>
    </div>
</body>