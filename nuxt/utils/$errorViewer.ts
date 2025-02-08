export const $errorViewer = (errorObj,errorsMsg) => {
    Object.keys(errorObj).forEach(key=> {
        if(errorsMsg[key]) {
            errorObj[key] = errorsMsg[key].reduce((a,b)=>a+', '+b);
        }

    });
}
