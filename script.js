import http from 'k6/http';

import { sleep } from 'k6';

export const options = {

    vus: 10,

    duration: '1s',

};

export default function () {

    http.get('https://anandadimmas.my.id/api/testing');

    sleep(1);

}