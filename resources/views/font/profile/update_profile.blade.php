@extends('font.master.mastering')

@section('title')
Update
@endsection

@section('content')
<div class="row justify-content-center py-5">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <h3 class="text-center" style="color: white; font-weight: bold;">Update Profile</h3>
            <div id="responseMessage"></div>
            <form id="UpdateUserForm">
                <div class="form-group mb-3">
                    <label class="form-label">Division</label>
                    <select class="form-select" id="division" required>
                        <option selected disabled>Choose your division</option>
                        <option value="Dhaka">Dhaka</option>
                        <option value="Chattogram">Chattogram</option>
                        <option value="Khulna">Khulna</option>
                        <option value="Barishal">Barishal</option>
                        <option value="Sylhet">Sylhet</option>
                        <option value="Rajshahi">Rajshahi</option>
                        <option value="Rangpur">Rangpur</option>
                        <option value="Mymensingh">Mymensingh</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">District</label>
                    <select class="form-select" id="district" required>
                        <option selected disabled>Choose your district</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Home District</label>
                    <select class="form-select" id="home-district" required>
                        <option selected disabled>Choose your home district</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Old Password</label>
                    <input type="password" class="form-control" id="old_password" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    const districtsByDivision = {
        Dhaka: ["Dhaka", "Gazipur", "Kishoreganj", "Manikganj", "Munshiganj", "Narayanganj", "Narsingdi", "Tangail"],
        Chattogram: ["Bandarban", "Brahmanbaria", "Chandpur", "Chattogram", "CoxsBazar", "Cumilla", "Feni", "Khagrachari", "Lakshmipur", "Noakhali", "Rangamati"],
        Khulna: ["Bagerhat", "Chuadanga", "Jashore", "Jhenaidah", "Khulna", "Kushtia", "Magura", "Meherpur", "Narail", "Satkhira"],
        Barishal: ["Barguna", "Barishal", "Bhola", "Jhalokathi", "Patuakhali", "Pirojpur"],
        Sylhet: ["Habiganj", "Moulvibazar", "Sunamganj", "Sylhet"],
        Rajshahi: ["Bogra", "Chapainawabganj", "Joypurhat", "Naogaon", "Natore", "Pabna", "Rajshahi", "Sirajganj"],
        Rangpur: ["Dinajpur", "Gaibandha", "Kurigram", "Lalmonirhat", "Nilphamari", "Panchagarh", "Rangpur", "Thakurgaon"],
        Mymensingh: ["Jamalpur", "Mymensingh", "Netrokona", "Sherpur"]
    };
            const upojelaByDistrict = 
            {
        Dhaka: {
            Dhaka: ["Kotwali", "Savar", "Dhanmondi"],
            Gazipur: ["Gazipur Sadar", "Tongi", "Kaliakoir"],
            Kishoreganj: ["Kishoreganj Sadar", "Bhairab", "Katiadi"],
            Manikganj: ["Manikganj Sadar", "Singair", "Saturia"],
            Munshiganj: ["Munshiganj Sadar", "Sreenagar", "Tongibari"],
            Narayanganj: ["Narayanganj Sadar", "Rupganj", "Sonargaon"],
            Narsingdi: ["Narsingdi Sadar", "Palash", "Raipura"],
            Tangail: ["Tangail Sadar", "Mirzapur", "Sakhipur"]
        },
        Chattogram: {
            Bandarban: ["Bandarban Sadar", "Thanchi", "Ruma"],
            Brahmanbaria: ["Brahmanbaria Sadar", "Ashuganj", "Nabinagar"],
            Chandpur: ["Chandpur Sadar", "Hajiganj", "Matlab Uttar"],
            Chattogram: ["Chattogram Sadar", "Patiya", "Sitakunda"],
            CoxsBazar: ["Cox's Bazar Sadar", "Teknaf", "Ukhia"],
            Cumilla: ["Cumilla Sadar", "Debidwar", "Laksham"],
            Feni: ["Feni Sadar", "Daganbhuiyan", "Parshuram", "Sonagazi"],
            Khagrachari: ["Khagrachari Sadar", "Dighinala", "Mahalchhari"],
            Lakshmipur: ["Lakshmipur Sadar", "Raipur", "Ramganj"],
            Noakhali: ["Noakhali Sadar", "Begumganj", "Chatkhil"],
            Rangamati: ["Rangamati Sadar", "Kaptai", "Baghaichhari"]
        },
        Khulna: {
            Bagerhat: ["Bagerhat Sadar", "Mongla", "Rampal"],
            Chuadanga: ["Chuadanga Sadar", "Alamdanga", "Damurhuda"],
            Jashore: ["Jashore Sadar", "Bagherpara", "Jhikargacha"],
            Jhenaidah: ["Jhenaidah Sadar", "Maheshpur", "Kotchandpur"],
            Khulna: ["Khulna Sadar", "Dumuria", "Paikgachha"],
            Kushtia: ["Kushtia Sadar", "Kumarkhali", "Mirpur"],
            Magura: ["Magura Sadar", "Mohammadpur", "Shalikha"],
            Meherpur: ["Meherpur Sadar", "Mujibnagar", "Gangni"],
            Narail: ["Narail Sadar", "Lohagara", "Kalia"],
            Satkhira: ["Satkhira Sadar", "Shyamnagar", "Tala"]
        },
        Barishal: {
            Barguna: ["Barguna Sadar", "Amtali", "Patharghata"],
            Barishal: ["Barishal Sadar", "Babuganj", "Banaripara"],
            Bhola: ["Bhola Sadar", "Lalmohan", "Char Fasson"],
            Jhalokathi: ["Jhalokathi Sadar", "Kathalia", "Nalchity"],
            Patuakhali: ["Patuakhali Sadar", "Galachipa", "Dumki"],
            Pirojpur: ["Pirojpur Sadar", "Nazirpur", "Bhandaria"]
        },
        Sylhet: {
            Habiganj: ["Habiganj Sadar", "Madhabpur", "Bahubal"],
            Moulvibazar: ["Moulvibazar Sadar", "Srimangal", "Kamalganj"],
            Sunamganj: ["Sunamganj Sadar", "Jagannathpur", "Tahirpur"],
            Sylhet: ["Sylhet Sadar", "Beanibazar", "Golapganj"]
        },
        Rajshahi: {
            Bogra: ["Bogra Sadar", "Sherpur", "Shibganj"],
            Chapainawabganj: ["Chapainawabganj Sadar", "Gomostapur", "Shibganj"],
            Joypurhat: ["Joypurhat Sadar", "Panchbibi", "Akkelpur"],
            Naogaon: ["Naogaon Sadar", "Manda", "Badalgachhi"],
            Natore: ["Natore Sadar", "Baraigram", "Lalpur"],
            Pabna: ["Pabna Sadar", "Ishwardi", "Sujanagar"],
            Rajshahi: ["Rajshahi Sadar", "Paba", "Godagari"],
            Sirajganj: ["Sirajganj Sadar", "Kazipur", "Ullapara"]
        },
        Rangpur: {
            Dinajpur: ["Dinajpur Sadar", "Birampur", "Parbatipur"],
            Gaibandha: ["Gaibandha Sadar", "Gobindaganj", "Sundarganj"],
            Kurigram: ["Kurigram Sadar", "Bhurungamari", "Ulipur"],
            Lalmonirhat: ["Lalmonirhat Sadar", "Hatibandha", "Patgram"],
            Nilphamari: ["Nilphamari Sadar", "Jaldhaka", "Saidpur"],
            Panchagarh: ["Panchagarh Sadar", "Tetulia", "Boda"],
            Rangpur: ["Rangpur Sadar", "Badarganj", "Pirganj"],
            Thakurgaon: ["Thakurgaon Sadar", "Baliadangi", "Ranisankail"]
        },
        Mymensingh: {
            Jamalpur: ["Jamalpur Sadar", "Dewanganj", "Islampur"],
            Mymensingh: ["Mymensingh Sadar", "Trishal", "Gafargaon"],
            Netrokona: ["Netrokona Sadar", "Mohanganj", "Kendua"],
            Sherpur: ["Sherpur Sadar", "Nalitabari", "Sreebardi"]
        }
    };

    document.getElementById("division").addEventListener("change", function() {
        const division = this.value;
        const districtSelect = document.getElementById("district");
        const homeDistrictSelect = document.getElementById("home-district");
        
        districtSelect.innerHTML = '<option selected disabled>Choose your district</option>';
        homeDistrictSelect.innerHTML = '<option selected disabled>Choose your home district</option>';
        
        if (districtsByDivision[division]) {
            districtsByDivision[division].forEach(district => {
                let option = new Option(district, district);
                districtSelect.add(option);
            });
        }
    });

    // When district is selected, update home district with Upojela
    document.getElementById("district").addEventListener("change", function() {
        const district = this.value;
        const homeDistrictSelect = document.getElementById("home-district");

        homeDistrictSelect.innerHTML = '<option selected disabled>Choose your home district</option>';

        if (district && upojelaByDistrict[document.getElementById("division").value] && upojelaByDistrict[document.getElementById("division").value][district]) {
            upojelaByDistrict[document.getElementById("division").value][district].forEach(upojela => {
                let option = new Option(upojela, upojela);
                homeDistrictSelect.add(option);
            });
        }
    });
    $("#UpdateUserForm").submit(function (event) {
        event.preventDefault();

        const formData = {
            division: $("#division").val(),
            district: $("#district").val(),
            home_district: $("#home-district").val(),
            address: $("#address").val(),
            old_password: $("#old_password").val(),
            password: $("#password").val()
        };

        $.ajax({
            url: "{{ url('/update_user') }}",
            type: "POST",
            data: formData,
            success: function (response) {
                if (response.status === "success") {
                    $("#responseMessage").html('<div class="alert alert-success">' + response.message + '</div>');
                    $("#UpdateUserForm")[0].reset();
                } else {
                    $("#responseMessage").html('<div class="alert alert-danger">' + response.message + '</div>');
                }
                
            },
            error: function () {
                $("#responseMessage").html('<div class="alert alert-danger">Something went wrong. Please try again.</div>');
            }
        });
    });
</script>
@endpush

@push('link')
<style>
    body {
        /* background: rgb(12, 6, 6); */
        /* display: flex; */
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .card {
        background: rgb(12, 6, 6);
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(1, 29, 241, 0.1);
    }
    .form-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
    } 
    .form-row .form-group {
        flex: 1;
    }
</style> 
@endpush