import React, {useState, useRef} from "react";
import Modal from "components/common/modal/Modal";
import ShowList from "components/common/modal/ShowList";
import useClick from "../../modules/hooks/useClick";
import ConfirmResult from "./modal/ConfirmResult";
import conf from 'conf/conf';
import ScheduleConf from "../../conf/scheduleConf";

const Schedule = (props) => {
    const [isOpen, setIsOpen] = useState(false);

    function handleOpen() {
        setIsOpen(true);
    }

    function handleClose() {
        setIsOpen(false);
    }

    const ref = useClick(handleOpen);

    return (
        <div className="status" ref={ref}>
            <p className={props.status}>{props.children}</p>
            <Modal isOpen={isOpen} onRequestClose={handleClose}>
                {props.status === "yellow" ? (
                    <ConfirmResult scheduleId={props.schduleId}/>
                ) : (
                    <ShowList handleClose={handleClose} isOpen={isOpen}/>
                )}
            </Modal>
        </div>
    );
};

export default function ScheduleTable({scheduleList}) {
    const printSchedule = (v) => {
        if (v) {
            switch (v.status) {
                case ScheduleConf.STATUS.RESERVATION_NOTHING:
                    return <Schedule status="gray oneline" scheduleId={v.scheduleId}>예약 없음</Schedule>;
                case ScheduleConf.STATUS.RESERVATION_DONE:
                    return <Schedule status="mint oneline" scheduleId={v.scheduleId}>{v.value}명 예약 완료</Schedule>;
                case ScheduleConf.STATUS.RESULT_IN_PROGRESS:
                    if (typeof v.value === "object") {
                        return (
                            <Schedule status="blue" scheduleId={v.scheduleId}>
                                {`신청한 학생:${v.value[0]}`}
                                <br/>
                                {`예약 미승인:${v.value[1]}`}
                            </Schedule>
                        );
                    } else {
                        return (
                            <>
                                <Schedule status="blue oneline"
                                          scheduleId={v.scheduleId}>{`예약 미승인:${v.value}`}</Schedule>
                            </>
                        );
                    }
                case ScheduleConf.STATUS.RESULT_IN_PROGRESS:
                    return (
                        <Schedule status="yellow" scheduleId={v.scheduleId}>
                            {`참가학생:${v.value}`}
                            <br/>
                            [결과 미승인]
                        </Schedule>
                    );
                case ScheduleConf.STATUS.RESULT_DONE:
                    return <Schedule status="purple oneline" scheduleId={v.scheduleId}>결과 입력완료</Schedule>;
                default:
                    return "";
            }
        } else {
            return "";
        }
    };

    // 필요기능 클릭 시 해당 스케줄 정보
    return (
        <div className="scroll_area">
            <ul className="sch_time">
                <li>9AM</li>
                <li>10AM</li>
                <li>11AM</li>
                <li>12PM</li>
                <li>1PM</li>
                <li>2PM</li>
                <li>3PM</li>
                <li>4PM</li>
                <li>5PM</li>
                <li>6PM</li>
            </ul>
            <table className="sch_table">
                <colgroup>
                    <col width="5%"/>
                    <col width="14%"/>
                    <col width="9%" span="9"/>
                </colgroup>
                <tbody>
                {
                    scheduleList.map((value) => {
                        console.log(value)
                        value.map((value, index)=>{
                            return (
                                <tr key={index}>
                                    <td>{value.name}</td>
                                    {value.schedule.map((v, index) => (
                                        <td key={index}>{printSchedule(v)}</td>
                                    ))}
                                </tr>
                            )
                        })
                    })
                }
                </tbody>
            </table>
        </div>
    );
}