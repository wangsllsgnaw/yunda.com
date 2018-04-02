<?php
/**
 * Created by PhpStorm.
 * User: wangsl
 * Date: 2017/10/14
 * Time: 16:35
 */
/*
 * 泰康在线理赔地区初始化
 * */
return [
    'claim_flag'=>'{"province":[{"provincename":"\u5317\u4eac","provincecode":"1"},{"provincename":"\u6e56\u5317","provincecode":"2"},{"provincename":"\u5e7f\u4e1c","provincecode":"3"},{"provincename":"\u4e0a\u6d77","provincecode":"4"},{"provincename":"\u56db\u5ddd","provincecode":"5"},{"provincename":"\u8fbd\u5b81","provincecode":"6"},{"provincename":"\u9655\u897f","provincecode":"7"},{"provincename":"\u6d77\u5357","provincecode":"8"},{"provincename":"\u6c5f\u82cf","provincecode":"A"},{"provincename":"\u6d59\u6c5f","provincecode":"B"},{"provincename":"\u5c71\u4e1c","provincecode":"C"},{"provincename":"\u6cb3\u5357","provincecode":"D"},{"provincename":"\u5929\u6d25","provincecode":"E"},{"provincename":"\u91cd\u5e86","provincecode":"F"},{"provincename":"\u798f\u5efa","provincecode":"G"},{"provincename":"\u6e56\u5357","provincecode":"H"},{"provincename":"\u6df1\u5733","provincecode":"I"},{"provincename":"\u5b89\u5fbd","provincecode":"J"},{"provincename":"\u5927\u8fde","provincecode":"K"},{"provincename":"\u9752\u5c9b","provincecode":"L"},{"provincename":"\u5b81\u6ce2","provincecode":"M"},{"provincename":"\u6cb3\u5317","provincecode":"N"},{"provincename":"\u9ed1\u9f99\u6c5f","provincecode":"O"},{"provincename":"\u4e91\u5357","provincecode":"P"},{"provincename":"\u5409\u6797","provincecode":"Q"},{"provincename":"\u5c71\u897f","provincecode":"R"},{"provincename":"\u65b0\u7586","provincecode":"S"},{"provincename":"\u6c5f\u897f","provincecode":"T"},{"provincename":"\u5e7f\u897f","provincecode":"U"},{"provincename":"\u5185\u8499\u53e4","provincecode":"V"},{"provincename":"\u7518\u8083","provincecode":"W"},{"provincename":"\u5b81\u590f","provincecode":"X"},{"provincename":"\u8d35\u5dde","provincecode":"Y"},{"provincename":"\u9752\u6d77","provincecode":"Z"},{"provincename":"\u897f\u85cf","provincecode":"a"}],"city":[{"cityname":"\u5317\u4eac","citycode":"110"},{"cityname":"\u6b66\u6c49","citycode":"210"},{"cityname":"\u5b9c\u660c","citycode":"220"},{"cityname":"\u8944\u6a0a","citycode":"230"},{"cityname":"\u8346\u5dde","citycode":"240"},{"cityname":"\u5341\u5830","citycode":"250"},{"cityname":"\u9ec4\u77f3","citycode":"260"},{"cityname":"\u8346\u95e8","citycode":"270"},{"cityname":"\u5b5d\u611f","citycode":"280"},{"cityname":"\u54b8\u5b81","citycode":"290"},{"cityname":"\u9ec4\u5188","citycode":"2A0"},{"cityname":"\u968f\u5dde","citycode":"2B0"},{"cityname":"\u9102\u5dde","citycode":"2C0"},{"cityname":"\u6069\u65bd","citycode":"2D0"},{"cityname":"\u6f5c\u6c5f","citycode":"2E0"},{"cityname":"\u4ed9\u6843","citycode":"2F0"},{"cityname":"\u5929\u95e8","citycode":"2G0"},{"cityname":"\u5e7f\u5dde","citycode":"310"},{"cityname":"\u4f5b\u5c71","citycode":"320"},{"cityname":"\u4e1c\u839e","citycode":"330"},{"cityname":"\u4e2d\u5c71","citycode":"340"},{"cityname":"\u6c5f\u95e8","citycode":"350"},{"cityname":"\u73e0\u6d77","citycode":"360"},{"cityname":"\u6c55\u5934","citycode":"370"},{"cityname":"\u8302\u540d","citycode":"380"},{"cityname":"\u6e5b\u6c5f","citycode":"390"},{"cityname":"\u8087\u5e86","citycode":"3A0"},{"cityname":"\u60e0\u5dde","citycode":"3B0"},{"cityname":"\u97f6\u5173","citycode":"3C0"},{"cityname":"\u6885\u5dde","citycode":"3D0"},{"cityname":"\u6f6e\u5dde","citycode":"3E0"},{"cityname":"\u63ed\u9633","citycode":"3F0"},{"cityname":"\u6c55\u5c3e","citycode":"3G0"},{"cityname":"\u6cb3\u6e90","citycode":"3H0"},{"cityname":"\u6e05\u8fdc","citycode":"3I0"},{"cityname":"\u4e91\u6d6e","citycode":"3J0"},{"cityname":"\u9633\u6c5f","citycode":"3K0"},{"cityname":"\u4e0a\u6d77","citycode":"410"},{"cityname":"\u6210\u90fd","citycode":"510"},{"cityname":"\u7ef5\u9633","citycode":"520"},{"cityname":"\u5fb7\u9633","citycode":"530"},{"cityname":"\u5357\u5145","citycode":"540"},{"cityname":"\u5b9c\u5bbe","citycode":"550"},{"cityname":"\u9042\u5b81","citycode":"560"},{"cityname":"\u7709\u5c71","citycode":"570"},{"cityname":"\u8d44\u9633","citycode":"580"},{"cityname":"\u81ea\u8d21","citycode":"590"},{"cityname":"\u4e50\u5c71","citycode":"5A0"},{"cityname":"\u5185\u6c5f","citycode":"5B0"},{"cityname":"\u6cf8\u5dde","citycode":"5C0"},{"cityname":"\u8fbe\u5dde","citycode":"5D0"},{"cityname":"\u5e7f\u5b89","citycode":"5E0"},{"cityname":"\u96c5\u5b89","citycode":"5F0"},{"cityname":"\u5e7f\u5143","citycode":"5G0"},{"cityname":"\u5df4\u4e2d","citycode":"5H0"},{"cityname":"\u51c9\u5c71","citycode":"5I0"},{"cityname":"\u6500\u679d\u82b1","citycode":"5J0"},{"cityname":"\u6210\u90fd\u90ca\u53bf","citycode":"5L0"},{"cityname":"\u963f\u575d","citycode":"5M0"},{"cityname":"\u7518\u5b5c","citycode":"5N0"},{"cityname":"\u6c88\u9633","citycode":"610"},{"cityname":"\u8425\u53e3","citycode":"620"},{"cityname":"\u672c\u6eaa","citycode":"630"},{"cityname":"\u629a\u987a","citycode":"640"},{"cityname":"\u978d\u5c71","citycode":"650"},{"cityname":"\u4e39\u4e1c","citycode":"660"},{"cityname":"\u9526\u5dde","citycode":"670"},{"cityname":"\u8fbd\u9633","citycode":"680"},{"cityname":"\u846b\u82a6\u5c9b","citycode":"690"},{"cityname":"\u76d8\u9526","citycode":"6A0"},{"cityname":"\u94c1\u5cad","citycode":"6B0"},{"cityname":"\u671d\u9633","citycode":"6C0"},{"cityname":"\u961c\u65b0","citycode":"6D0"},{"cityname":"\u897f\u5b89","citycode":"710"},{"cityname":"\u54b8\u9633","citycode":"720"},{"cityname":"\u5b9d\u9e21","citycode":"730"},{"cityname":"\u5b89\u5eb7","citycode":"740"},{"cityname":"\u6c49\u4e2d","citycode":"750"},{"cityname":"\u6e2d\u5357","citycode":"760"},{"cityname":"\u6986\u6797","citycode":"770"},{"cityname":"\u94dc\u5ddd","citycode":"780"},{"cityname":"\u5546\u6d1b","citycode":"790"},{"cityname":"\u5ef6\u5b89","citycode":"7A0"},{"cityname":"\u6d77\u53e3","citycode":"810"},{"cityname":"\u510b\u5dde","citycode":"820"},{"cityname":"\u4e09\u4e9a","citycode":"830"},{"cityname":"\u743c\u6d77","citycode":"840"},{"cityname":"\u5357\u4eac","citycode":"A10"},{"cityname":"\u5e38\u5dde","citycode":"A20"},{"cityname":"\u82cf\u5dde","citycode":"A30"},{"cityname":"\u626c\u5dde","citycode":"A40"},{"cityname":"\u5f90\u5dde","citycode":"A50"},{"cityname":"\u65e0\u9521","citycode":"A60"},{"cityname":"\u5357\u901a","citycode":"A70"},{"cityname":"\u9547\u6c5f","citycode":"A80"},{"cityname":"\u8fde\u4e91\u6e2f","citycode":"A90"},{"cityname":"\u6cf0\u5dde","citycode":"AA0"},{"cityname":"\u76d0\u57ce","citycode":"AB0"},{"cityname":"\u5bbf\u8fc1","citycode":"AC0"},{"cityname":"\u6dee\u5b89","citycode":"AD0"},{"cityname":"\u676d\u5dde","citycode":"B10"},{"cityname":"\u7ecd\u5174","citycode":"B20"},{"cityname":"\u53f0\u5dde","citycode":"B30"},{"cityname":"\u91d1\u534e","citycode":"B40"},{"cityname":"\u6e29\u5dde","citycode":"B50"},{"cityname":"\u6e56\u5dde","citycode":"B60"},{"cityname":"\u5609\u5174","citycode":"B70"},{"cityname":"\u4e3d\u6c34","citycode":"B80"},{"cityname":"\u821f\u5c71","citycode":"B90"},{"cityname":"\u8862\u5dde","citycode":"BA0"},{"cityname":"\u6d4e\u5357","citycode":"C10"},{"cityname":"\u70df\u53f0","citycode":"C20"},{"cityname":"\u6f4d\u574a","citycode":"C30"},{"cityname":"\u6dc4\u535a","citycode":"C40"},{"cityname":"\u6d4e\u5b81","citycode":"C50"},{"cityname":"\u4e34\u6c82","citycode":"C60"},{"cityname":"\u5a01\u6d77","citycode":"C70"},{"cityname":"\u4e1c\u8425","citycode":"C80"},{"cityname":"\u6cf0\u5b89","citycode":"C90"},{"cityname":"\u6ee8\u5dde","citycode":"CA0"},{"cityname":"\u65e5\u7167","citycode":"CB0"},{"cityname":"\u5fb7\u5dde","citycode":"CC0"},{"cityname":"\u67a3\u5e84","citycode":"CD0"},{"cityname":"\u804a\u57ce","citycode":"CE0"},{"cityname":"\u83cf\u6cfd","citycode":"CF0"},{"cityname":"\u83b1\u829c","citycode":"CG0"},{"cityname":"\u90d1\u5dde","citycode":"D10"},{"cityname":"\u6fee\u9633","citycode":"D20"},{"cityname":"\u5b89\u9633","citycode":"D30"},{"cityname":"\u5357\u9633","citycode":"D40"},{"cityname":"\u6d1b\u9633","citycode":"D50"},{"cityname":"\u65b0\u4e61","citycode":"D60"},{"cityname":"\u5e73\u9876\u5c71","citycode":"D70"},{"cityname":"\u7126\u4f5c","citycode":"D80"},{"cityname":"\u8bb8\u660c","citycode":"D90"},{"cityname":"\u5f00\u5c01","citycode":"DA0"},{"cityname":"\u5546\u4e18","citycode":"DB0"},{"cityname":"\u5468\u53e3","citycode":"DC0"},{"cityname":"\u4e09\u95e8\u5ce1","citycode":"DD0"},{"cityname":"\u9a7b\u9a6c\u5e97","citycode":"DE0"},{"cityname":"\u9e64\u58c1","citycode":"DF0"},{"cityname":"\u4fe1\u9633","citycode":"DG0"},{"cityname":"\u6f2f\u6cb3","citycode":"DH0"},{"cityname":"\u6d4e\u6e90","citycode":"DI0"},{"cityname":"\u5929\u6d25","citycode":"E10"},{"cityname":"\u91cd\u5e86","citycode":"F10"},{"cityname":"\u4e07\u5dde","citycode":"F20"},{"cityname":"\u6daa\u9675","citycode":"F30"},{"cityname":"\u6c5f\u6d25","citycode":"F40"},{"cityname":"\u9ed4\u6c5f","citycode":"F50"},{"cityname":"\u91cd\u5e86\u672c\u90e8","citycode":"F60"},{"cityname":"\u798f\u5dde","citycode":"G10"},{"cityname":"\u5357\u5e73","citycode":"G20"},{"cityname":"\u6cc9\u5dde","citycode":"G30"},{"cityname":"\u6f33\u5dde","citycode":"G40"},{"cityname":"\u5b81\u5fb7","citycode":"G50"},{"cityname":"\u53a6\u95e8","citycode":"G60"},{"cityname":"\u8386\u7530","citycode":"G70"},{"cityname":"\u4e09\u660e","citycode":"G80"},{"cityname":"\u9f99\u5ca9","citycode":"G90"},{"cityname":"\u957f\u6c99","citycode":"H10"},{"cityname":"\u6e58\u6f6d","citycode":"H20"},{"cityname":"\u8861\u9633","citycode":"H30"},{"cityname":"\u682a\u6d32","citycode":"H40"},{"cityname":"\u5cb3\u9633","citycode":"H50"},{"cityname":"\u5e38\u5fb7","citycode":"H60"},{"cityname":"\u90f4\u5dde","citycode":"H70"},{"cityname":"\u90b5\u9633","citycode":"H80"},{"cityname":"\u76ca\u9633","citycode":"H90"},{"cityname":"\u5a04\u5e95","citycode":"HA0"},{"cityname":"\u6000\u5316","citycode":"HB0"},{"cityname":"\u5f20\u5bb6\u754c","citycode":"HC0"},{"cityname":"\u5409\u9996","citycode":"HD0"},{"cityname":"\u6c38\u5dde","citycode":"HE0"},{"cityname":"\u6df1\u5733","citycode":"I10"},{"cityname":"\u5408\u80a5","citycode":"J10"},{"cityname":"\u9a6c\u978d\u5c71","citycode":"J20"},{"cityname":"\u868c\u57e0","citycode":"J30"},{"cityname":"\u829c\u6e56","citycode":"J40"},{"cityname":"\u5b89\u5e86","citycode":"J50"},{"cityname":"\u6dee\u5357","citycode":"J60"},{"cityname":"\u516d\u5b89","citycode":"J70"},{"cityname":"\u5ba3\u57ce","citycode":"J80"},{"cityname":"\u6ec1\u5dde","citycode":"J90"},{"cityname":"\u5bbf\u5dde","citycode":"JA0"},{"cityname":"\u961c\u9633","citycode":"JB0"},{"cityname":"\u4eb3\u5dde","citycode":"JD0"},{"cityname":"\u6dee\u5317","citycode":"JE0"},{"cityname":"\u9ec4\u5c71","citycode":"JF0"},{"cityname":"\u94dc\u9675","citycode":"JG0"},{"cityname":"\u6c60\u5dde","citycode":"JH0"},{"cityname":"\u5927\u8fde","citycode":"K10"},{"cityname":"\u9752\u5c9b","citycode":"L10"},{"cityname":"\u5b81\u6ce2","citycode":"M10"},{"cityname":"\u77f3\u5bb6\u5e84","citycode":"N10"},{"cityname":"\u5eca\u574a","citycode":"N20"},{"cityname":"\u79e6\u7687\u5c9b","citycode":"N30"},{"cityname":"\u5510\u5c71","citycode":"N40"},{"cityname":"\u90af\u90f8","citycode":"N50"},{"cityname":"\u4fdd\u5b9a","citycode":"N60"},{"cityname":"\u90a2\u53f0","citycode":"N70"},{"cityname":"\u6ca7\u5dde","citycode":"N80"},{"cityname":"\u8861\u6c34","citycode":"N90"},{"cityname":"\u627f\u5fb7","citycode":"NA0"},{"cityname":"\u5f20\u5bb6\u53e3","citycode":"NB0"},{"cityname":"\u54c8\u5c14\u6ee8","citycode":"O10"},{"cityname":"\u9f50\u9f50\u54c8\u5c14","citycode":"O20"},{"cityname":"\u7ee5\u5316","citycode":"O30"},{"cityname":"\u5927\u5e86","citycode":"O40"},{"cityname":"\u4f0a\u6625","citycode":"O50"},{"cityname":"\u7261\u4e39\u6c5f","citycode":"O60"},{"cityname":"\u4f73\u6728\u65af","citycode":"O70"},{"cityname":"\u5927\u5174\u5b89\u5cad","citycode":"O80"},{"cityname":"\u9ed1\u6cb3","citycode":"O90"},{"cityname":"\u9e64\u5c97","citycode":"OA0"},{"cityname":"\u9e21\u897f","citycode":"OB0"},{"cityname":"\u53cc\u9e2d\u5c71","citycode":"OD0"},{"cityname":"\u6606\u660e","citycode":"P10"},{"cityname":"\u7389\u6eaa","citycode":"P20"},{"cityname":"\u7ea2\u6cb3","citycode":"P30"},{"cityname":"\u5927\u7406","citycode":"P40"},{"cityname":"\u897f\u53cc\u7248\u7eb3","citycode":"P50"},{"cityname":"\u66f2\u9756","citycode":"P60"},{"cityname":"\u695a\u96c4","citycode":"P70"},{"cityname":"\u4e3d\u6c5f","citycode":"P80"},{"cityname":"\u666e\u6d31","citycode":"P90"},{"cityname":"\u5fb7\u5b8f","citycode":"PA0"},{"cityname":"\u6587\u5c71","citycode":"PB0"},{"cityname":"\u4fdd\u5c71","citycode":"PC0"},{"cityname":"\u662d\u901a","citycode":"PD0"},{"cityname":"\u4e34\u6ca7","citycode":"PE0"},{"cityname":"\u8fea\u5e86","citycode":"PF0"},{"cityname":"\u6012\u6c5f","citycode":"PG0"},{"cityname":"\u957f\u6625","citycode":"Q10"},{"cityname":"\u5409\u6797","citycode":"Q20"},{"cityname":"\u901a\u5316","citycode":"Q30"},{"cityname":"\u5ef6\u5409","citycode":"Q40"},{"cityname":"\u677e\u539f","citycode":"Q50"},{"cityname":"\u767d\u57ce","citycode":"Q60"},{"cityname":"\u56db\u5e73","citycode":"Q70"},{"cityname":"\u8fbd\u6e90","citycode":"Q80"},{"cityname":"\u767d\u5c71","citycode":"Q90"},{"cityname":"\u592a\u539f","citycode":"R10"},{"cityname":"\u4e34\u6c7e","citycode":"R20"},{"cityname":"\u5927\u540c","citycode":"R30"},{"cityname":"\u664b\u4e2d","citycode":"R40"},{"cityname":"\u8fd0\u57ce","citycode":"R50"},{"cityname":"\u664b\u57ce","citycode":"R60"},{"cityname":"\u957f\u6cbb","citycode":"R70"},{"cityname":"\u5415\u6881","citycode":"R80"},{"cityname":"\u9633\u6cc9","citycode":"R90"},{"cityname":"\u6714\u5dde","citycode":"RA0"},{"cityname":"\u5ffb\u5dde","citycode":"RB0"},{"cityname":"\u4e4c\u9c81\u6728\u9f50","citycode":"S10"},{"cityname":"\u77f3\u6cb3\u5b50","citycode":"S20"},{"cityname":"\u4f0a\u7281","citycode":"S30"},{"cityname":"\u54c8\u5bc6","citycode":"S40"},{"cityname":"\u5854\u57ce","citycode":"S50"},{"cityname":"\u660c\u5409","citycode":"S60"},{"cityname":"\u5df4\u97f3\u90ed\u695e","citycode":"S70"},{"cityname":"\u5580\u4ec0","citycode":"S80"},{"cityname":"\u963f\u514b\u82cf","citycode":"S90"},{"cityname":"\u5410\u9c81\u756a","citycode":"SA0"},{"cityname":"\u535a\u5dde","citycode":"SB0"},{"cityname":"\u514b\u62c9\u739b\u4f9d","citycode":"SC0"},{"cityname":"\u594e\u5c6f","citycode":"SD0"},{"cityname":"\u5357\u660c","citycode":"T10"},{"cityname":"\u4e5d\u6c5f","citycode":"T20"},{"cityname":"\u8d63\u5dde","citycode":"T30"},{"cityname":"\u4e0a\u9976","citycode":"T40"},{"cityname":"\u5b9c\u6625","citycode":"T50"},{"cityname":"\u5409\u5b89","citycode":"T60"},{"cityname":"\u629a\u5dde","citycode":"T70"},{"cityname":"\u65b0\u4f59","citycode":"T80"},{"cityname":"\u666f\u5fb7\u9547","citycode":"T90"},{"cityname":"\u9e70\u8c2d","citycode":"TA0"},{"cityname":"\u840d\u4e61","citycode":"TB0"},{"cityname":"\u5357\u5b81","citycode":"U10"},{"cityname":"\u67f3\u5dde","citycode":"U20"},{"cityname":"\u68a7\u5dde","citycode":"U30"},{"cityname":"\u6842\u6797","citycode":"U40"},{"cityname":"\u7389\u6797","citycode":"U50"},{"cityname":"\u767e\u8272","citycode":"U60"},{"cityname":"\u6cb3\u6c60","citycode":"U70"},{"cityname":"\u94a6\u5dde","citycode":"U80"},{"cityname":"\u5317\u6d77","citycode":"U90"},{"cityname":"\u8d3a\u5dde","citycode":"UA0"},{"cityname":"\u6765\u5bbe","citycode":"UB0"},{"cityname":"\u8d35\u6e2f","citycode":"UC0"},{"cityname":"\u9632\u57ce\u6e2f","citycode":"UD0"},{"cityname":"\u5d07\u5de6","citycode":"UE0"},{"cityname":"\u547c\u548c\u6d69\u7279","citycode":"V10"},{"cityname":"\u5305\u5934","citycode":"V20"},{"cityname":"\u9102\u5c14\u591a\u65af","citycode":"V30"},{"cityname":"\u8d64\u5cf0","citycode":"V40"},{"cityname":"\u5df4\u5f66\u6dd6\u5c14","citycode":"V50"},{"cityname":"\u901a\u8fbd","citycode":"V60"},{"cityname":"\u547c\u4f26\u8d1d\u5c14","citycode":"V70"},{"cityname":"\u4e4c\u5170\u5bdf\u5e03","citycode":"V80"},{"cityname":"\u9521\u6797\u90ed\u52d2","citycode":"V90"},{"cityname":"\u4e4c\u6d77","citycode":"VA0"},{"cityname":"\u5174\u5b89\u76df","citycode":"VB0"},{"cityname":"\u963f\u62c9\u5584\u76df","citycode":"VC0"},{"cityname":"\u5170\u5dde","citycode":"W10"},{"cityname":"\u6b66\u5a01","citycode":"W20"},{"cityname":"\u5929\u6c34","citycode":"W30"},{"cityname":"\u5f20\u6396","citycode":"W50"},{"cityname":"\u767d\u94f6","citycode":"W60"},{"cityname":"\u9152\u6cc9","citycode":"W70"},{"cityname":"\u5b9a\u897f","citycode":"W80"},{"cityname":"\u5e73\u51c9","citycode":"WA0"},{"cityname":"\u91d1\u660c","citycode":"WB0"},{"cityname":"\u9647\u5357","citycode":"WC0"},{"cityname":"\u94f6\u5ddd","citycode":"X10"},{"cityname":"\u5434\u5fe0","citycode":"X20"},{"cityname":"\u4e2d\u536b","citycode":"X30"},{"cityname":"\u77f3\u5634\u5c71","citycode":"X40"},{"cityname":"\u8d35\u9633","citycode":"Y10"},{"cityname":"\u9075\u4e49","citycode":"Y20"},{"cityname":"\u516d\u76d8\u6c34","citycode":"Y30"},{"cityname":"\u9ed4\u4e1c\u5357","citycode":"Y40"},{"cityname":"\u5b89\u987a","citycode":"Y50"},{"cityname":"\u90fd\u5300","citycode":"Y60"},{"cityname":"\u6bd5\u8282","citycode":"Y70"},{"cityname":"\u94dc\u4ec1","citycode":"Y80"},{"cityname":"\u9ed4\u897f\u5357","citycode":"Y90"},{"cityname":"\u897f\u5b81","citycode":"Z10"},{"cityname":"\u62c9\u8428","citycode":"a10"}]}'
];