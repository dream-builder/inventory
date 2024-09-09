@extends('index')

@section('content')
    <style>
        .question-section {
            padding-top: 10px;
            padding-bottom: 10px;

            position: relative;
            overflow: auto;
            border-bottom: solid 1px #ddd;
        }

        .question-section:hover {
            background-color: #ccc;
        }
    </style>
    <section class="content-header" style="margin-bottom: 25px">
        <h1 style="display: inline-block">
            General Information
        </h1>
    </section>

    <section>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title">A. Capacity Building status of respective RMG on MOTHRS@WORK </div>
                </div>
                <div class="box-body">
                    <div class="question-section">
                        <div class="col-md-6">
                            A1. Number of RMG senior-mid level Management Officials were oriented on M@W (since last
                            training %date%)
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            A1.1. Date of senior-mid level Management Officials orientation
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            A2. Number of RMG staff were trained by BGMEA/BKMEA Master Trainers
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>


                    <div class="question-section">
                        <div class="col-md-6">
                            A2.1. Date of RMG staff were trained by BGMEA/BKMEA Master Trainers
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>
                    {{-- A3 --}}
                    <div class="question-section">
                        <div class="col-md-6">
                            A3. Number of Respective RMG staff were trained by the BGMEA/BKMEA trained staff
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            A3.1. Date of RMG staff were trained by the BGMEA/BKMEA trained staff
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>


                    {{-- A4 --}}
                    <div class="question-section">
                        <div class="col-md-6">
                            A4. Does the RMG workplace display breastfeeding policy/guidance (Observed)
                        </div>

                        <div class="col-md-2">
                            <select class="form-control">
                                <option>-----</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            A5. No. of Health, Social Compliance, and Child-are providers who provide breastfeeding
                            counselling
                            service for the working lactating mothers
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            A6. No. of Health-care, Social Compliance, and Child-are providers who are able to state five
                            key
                            messes on breastfeeding
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            A7. Number of working women participated in awareness session on M@W components (IYCF, ECCD,
                            Maternal Nutrition)
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            A8. Number of male workers participated in awareness session on M@W in general and
                            breastfeeding-childcare practices, ECCD support in specific
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <h3>B. Basic Demographic Information on the workplace</h3>
                    <hr>

                    <div class="question-section">
                        <div class="col-md-6">
                            B1. Total No. of Workers
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            B2. No. of Female Worker
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            B3. No. of working pregnant mother
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            B4. No. of Working Lactating Mother (having &lt; 6 m old child) </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            B5. No. of Working Lactating Mother (having &lt; 6 m old child) continuing breastfeeding during
                            working hours </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            No. of Working Lactating Mother (having &lt;6 m old child) practicing exclusive breastfeeding
                            (only breast-milk – not even a drop of water for child &lt;181 days)
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>


                    <div class="question-section">
                        <div class="col-md-6">
                            B7. No. of Working Mother with 6-36 m old child
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            B8. No. of Working Mother with 6-36 m old child continuing breastfeeding during working
                            hours
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            B9. No. of 0-36 m old child at the RMG based Day-care center
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            B10. No. of staff (from HR, PHC, Child-daycare, Welfare/Compliance sections) trained on
                            MOTHERS@WORK seven standards implementation
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            B11. No. of staff in this RMG trained on intensive ECCD services
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            B12. No. of working parents provided parenting education/guide as per ECCD protocol for 0-3
                            years old children
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            B13. No. of RMG based PHC staff trained on maternal nutrition services following national
                            protocol
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <b>14. No. of Female workers including pregnant woman, lactating mothers and mothers of 0-36 months old
                        children raised awareness on </b>

                    <div class="question-section">
                        <div class="col-md-6">
                            14.1. Workplace policies/support services/entitlements on (i) Breastfeeding space, (ii)
                            Breastfeeding breaks, (iii) Child-care provisions, (iv) Paid maternity leave, (v) Cash & medical
                            benefits (vi) Employment protection/non-discrimination and (vii) Safe work provision during
                            pregnancy/maternity leave/breastfeeding
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>

                    <div class="question-section">
                        <div class="col-md-6">
                            14.2. Importance and recommended guidance eon maternal nutrition, breastfeeding, complementary
                            feeding practices and early child are and development intervention
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control" />
                        </div>
                    </div>









                </div>

                <div class="box-footer">
                    <button class="btn btn-success">Save</button>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('script')
    <script></script>
@endsection
