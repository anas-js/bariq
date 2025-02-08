export const $help = () => {
  return {
    toHtml(strHtml: string, selector: string = "body > *") {
      return new DOMParser()
        .parseFromString(strHtml, "text/html")
        .querySelector(selector) as HTMLElement;
    },
  };
};
