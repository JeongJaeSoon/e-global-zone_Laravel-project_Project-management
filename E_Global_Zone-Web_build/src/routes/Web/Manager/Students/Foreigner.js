import React, {useEffect, useState} from "react";
import conf from "conf/conf";
import useClick from "modules/hooks/useClick";
import useModal from "../../../../modules/hooks/useModal";
import Modal from "components/common/modal/Modal";
import ForeignerContact from "../../../../components/common/modal/ForeignerContact";
import InsertForeignerStudent from "../../../../components/common/modal/InsertForeignerStudent";
import {getAdminForeignerWork} from "../../../../modules/hooks/useAxios";
import {useSelector} from "react-redux";
import {selectDept} from "../../../../redux/confSlice/confSlice";

let i = 1601214;
let j = 0;

/**
 * Manager :: 유학생 관리
 * @returns {JSX.Element}
 * @constructor
 */
export default function Foreigner() {
    let mockup = {
        sort: null,
        data: [
            {
                std_for_lang: conf.language.ENGLISH,
                country: "미국",
                favorite: false,
                std_id: i++,
                name: "Emma Stone",
                dept: conf.shortDepartment[1],
                curruntMonth: 120,
                lastMonth: 150,
                thePastMonth: 560,
                count: j++,
                delay: 0,
                check: false,
            },
        ],
    };
    const [dataSet, setDataSet] = useState();
    const [data, setData] = useState(mockup.data);
    const {isOpen: contactIsOpen, handleOpen: handleOpenForContact, handleClose: handleCloseForContact} = useModal();
    const {isOpen: addIsOpen, handleOpen: handleOpenForAdd, handleClose: handleCloseForAdd} = useModal();
    const deptList = useSelector(selectDept)

    function handleCheckAll() {
        let flag = true;
        return function () {
            data.forEach(v => {
                document.getElementById(v.std_id).checked = flag;
                v.check = flag;
            })
            flag = !flag;
            console.log(data);
        }
    }

    useEffect(() => {
        window.easydropdown.all();
        getAdminForeignerWork(setDataSet);
    }, []);
    useEffect(() => {
        // console.log(dataSet.data);
        if (dataSet&& dataSet.hasOwnProperty("data")) {

            setData(dataSet)
        }

    }, [dataSet])

    useEffect(() => {
        console.log(data);
    }, [data])

    const returnDept = (deptId, deptList) => {
        let returnValue = "";
        deptList.forEach(v=>{
            if(v.dept_id === deptId){
                returnValue = v.dept_name[0]
            }
        })
        return returnValue;
    }

    const sort = (sortBy) => {
        setData([]); // reset
        if (mockup.sort === sortBy) {
            setData(mockup.data.sort((a, b) => (a[sortBy] > b[sortBy] ? -1 : 1)));
            mockup.sort = null;
        } else {
            setData(mockup.data.sort((a, b) => (a[sortBy] < b[sortBy] ? -1 : 1)));
            mockup.sort = sortBy;
        }
    };

    return (
        <div>
            <div className="content">
                <div className="sub_title">
                    <div className="top_semester">
                        <p className="tit">유학생 관리</p>
                        <select name="catgo" className="dropdown">
                            <option>2020학년도 1학기</option>
                            <option>2020학년도 여름학기</option>
                            <option>2020학년도 2학기</option>
                            <option>2020학년도 겨울학기</option>
                        </select>
                    </div>

                    <div className="top_search">
                        <select name="catgo" className="dropdown">
                            <option>이름</option>
                            <option>학번</option>
                            <option>연락처</option>
                        </select>
                        <input type="text"/>
                        <input type="submit" value="검색"/>
                    </div>
                </div>

                <div className="wrap">
                    <div className="scroll_area">
                        <table className="student_manage_table">
                            <colgroup>
                                <col width="5%"/>
                                <col width="7%" span="3"/>
                                <col width="7%"/>
                                <col width="13%"/>
                                <col width="7%"/>
                                <col width="7%" span="6"/>
                            </colgroup>
                            <thead>
                            <tr>
                                <th rowSpan="2">
                                    <div className="table_check">
                                        <input type="checkbox" id="a1" name="" onClick={handleCheckAll()}/>
                                        <label htmlFor="a1"></label>
                                    </div>
                                </th>
                                <th
                                    rowSpan="2"
                                    className="align"
                                    ref={useClick(() => {
                                        sort("language");
                                    })}
                                >
                                    언어{" "}
                                    <img
                                        src="/global/img/table_align_arrow.gif"
                                        alt="언어 기준 정렬"
                                    />
                                </th>
                                <th
                                    rowSpan="2"
                                    className="align"
                                    ref={useClick(() => {
                                        sort("country");
                                    })}
                                >
                                    국가명{" "}
                                    <img
                                        src="/global/img/table_align_arrow.gif"
                                        alt="국가명 기준 정렬"
                                    />
                                </th>
                                <th
                                    rowSpan="2"
                                    className="align"
                                    ref={useClick(() => {
                                        sort("favorite");
                                    })}
                                >
                                    즐겨찾기{" "}
                                    <img
                                        src="/global/img/table_align_arrow.gif"
                                        alt="즐겨찾기 기준 정렬"
                                    />
                                </th>
                                <th colSpan="3">유학생 정보</th>
                                <th colSpan="4">활동시간</th>
                                <th rowSpan="2" className="align">
                                    예약 미승인
                                    <br/>
                                    횟수
                                    <img
                                        src="/global/img/table_align_arrow.gif"
                                        alt="예약 미승인 횟수 기준 정렬"
                                    />
                                </th>
                                <th rowSpan="2" className="align">
                                    결과 지연
                                    <br/>
                                    입력 횟수
                                    <img
                                        src="/global/img/table_align_arrow.gif"
                                        alt="결과 지연 입력 횟수 기준 정렬"
                                    />
                                </th>
                            </tr>
                            <tr>
                                <th>학번</th>
                                <th>이름</th>
                                <th
                                    rowSpan="2"
                                    className="align"
                                    ref={useClick(() => {
                                        sort("dept");
                                    })}
                                >
                                    계열학과
                                    <img
                                        src="/global/img/table_align_arrow.gif"
                                        alt="계열학과 기준 정렬"
                                    />
                                </th>
                                <th rowSpan="2" className="align">
                                    합계
                                    <img
                                        src="/global/img/table_align_arrow.gif"
                                        alt="합계 기준 정렬"
                                    />
                                </th>
                                <th rowSpan="2" className="align">
                                    6월
                                    <img
                                        src="/global/img/table_align_arrow.gif"
                                        alt="6월 기준 정렬"
                                    />
                                </th>
                                <th rowSpan="2" className="align">
                                    7월
                                    <img
                                        src="/global/img/table_align_arrow.gif"
                                        alt="7월 기준 정렬"
                                    />
                                </th>
                                <th rowSpan="2" className="align">
                                    8월
                                    <img
                                        src="/global/img/table_align_arrow.gif"
                                        alt="8월 기준 정렬"
                                    />
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            {dataSet && dataSet.data.map((value, index) => {
                                return (
                                    <tr
                                        className={
                                            value.std_for_lang === conf.language.ENGLISH
                                                ? "eng"
                                                : value.std_for_lang === conf.language.JAPANESE
                                                ? "jp"
                                                : "ch"
                                        }
                                        key={value.std_for_id}
                                    >
                                        <td>
                                            <div className="table_check">
                                                <input
                                                    type="checkbox"
                                                    id={value.std_for_id}
                                                    name=""
                                                    ref={value.ref}
                                                    onClick={() => {
                                                        if (value.check) {
                                                            value.check = false;
                                                        } else {
                                                            value.check = true;
                                                        }
                                                    }}

                                                />
                                                <label htmlFor={value.std_for_id}></label>
                                            </div>
                                        </td>
                                        <td>{value.std_for_lang}</td>
                                        <td>{value.std_for_country}</td>
                                        <td>
                                            {value.favorite ? (
                                                <div className="favor">
                                                    <img
                                                        src="/global/img/favor_on.png"
                                                        alt="즐겨찾기 on"
                                                    />
                                                </div>
                                            ) : (
                                                <div className="favor">
                                                    <img
                                                        src="/global/img/favor_off.png"
                                                        alt="즐겨찾기 off"
                                                    />
                                                </div>
                                            )}
                                        </td>
                                        <td>{value.std_for_id}</td>
                                        <td onMouseOver={() => {
                                            document.getElementById(`hover_btn_${index}`).className = "hover_btn";
                                        }}
                                            onMouseOut={() => {
                                                document.getElementById(`hover_btn_${index}`).className = "off";
                                            }}
                                        >{value.std_for_name}
                                            <div id={`hover_btn_${index}`} className="hover_btn off">
                                                <div className="area">
                                                    <div className="navy">비밀번호 초기화</div>
                                                    <div className="lightGray">삭제</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{returnDept(value.std_for_dept, deptList)}</td>
                                        {/*<td>*/}
                                        {/*    {(*/}
                                        {/*        (value.curruntMonth +*/}
                                        {/*            value.lastMonth +*/}
                                        {/*            value.thePastMonth) /*/}
                                        {/*        60*/}
                                        {/*    ).toFixed(0)}*/}
                                        {/*    시간{" "}*/}
                                        {/*    {(value.curruntMonth +*/}
                                        {/*        value.lastMonth +*/}
                                        {/*        value.thePastMonth) %*/}
                                        {/*    60}*/}
                                        {/*    분*/}
                                        {/*</td>*/}
                                        {/*<td>*/}
                                        {/*    {(value.thePastMonth / 60).toFixed(0)}시간{" "}*/}
                                        {/*    {value.thePastMonth % 60}분*/}
                                        {/*</td>*/}
                                        {/*<td>*/}
                                        {/*    {(value.lastMonth / 60).toFixed(0)}시간{" "}*/}
                                        {/*    {value.lastMonth % 60}분*/}
                                        {/*</td>*/}
                                        {/*<td>*/}
                                        {/*    {(value.curruntMonth / 60).toFixed(0)}시간{" "}*/}
                                        {/*    {value.curruntMonth % 60}분*/}
                                        {/*</td>*/}
                                        {/*<td>{value.count}회</td>*/}
                                        {/*<td>{value.delay === 0 ? "-" : value.delay}</td>*/}
                                    </tr>
                                );
                            })}
                            </tbody>
                        </table>
                    </div>

                    <div className="table_btn">
                        <div onClick={handleOpenForContact}>연락처 정보</div>
                        <Modal isOpen={contactIsOpen} handleClose={handleCloseForContact}>
                            <ForeignerContact list={{}} handleClose={handleCloseForContact}/>
                        </Modal>
                        <div onClick={handleOpenForAdd}>등록</div>
                        {/*<div>CSV 다운</div>*/}
                    </div>
                    <Modal isOpen={addIsOpen} handleClose={handleCloseForAdd}>
                        <InsertForeignerStudent handleClose={handleCloseForAdd}/>
                    </Modal>
                </div>
            </div>
        </div>
    );
}