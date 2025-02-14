export const $help = () => {
  return {
    toHtml(strHtml: string, selector: string = "body > *") {
      return new DOMParser()
        .parseFromString(strHtml, "text/html")
        .querySelector(selector) as HTMLElement;
    },
    formatDate(date?: string) {
        const d = date ? new Date(date) : new Date();

        // if($i18n.locale !== "en") {
        //   return d.toLocaleString('en-US', {
        //     year: 'numeric',
        //     month: '2-digit',
        //     day: '2-digit',
        //     hour: '2-digit',
        //     minute: '2-digit',
        //     second: '2-digit',
        //     hour12: true,
        //   }).replace("PM",$t('gl.time.pm') as string).replace("AM",$t('gl.time.am') as string);
        // }
        return d.toLocaleString('ar-US', {
          year: '2-digit',
          month: '2-digit',
          day: '2-digit',
          hour: '2-digit',
          minute: '2-digit',
          second: '2-digit',
          hour12: true,
        });
    }
  };
};
