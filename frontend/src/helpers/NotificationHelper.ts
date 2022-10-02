import { notify } from "@kyvg/vue3-notification";

export default class NotificationHelper {
  static NotifySuccess(message = "", title = "") {
    if (!message) message = "Success";
    if (!title) title = "Success";

    notify({
        title: title,
        text: message,
        type: "success"
    });
  }

  static NotifyError(message: string, title = "") {
    if (!message) message = "Error";
    if (!title) title = "Error";

    notify({
        title: title,
        text: message,
        type: "error"
    });
  }

  static NotifyFormValidation(errors: object, title = "") {
    let message = "Error";
    if (!title) title = "Error";

    if(message) {
      let array = Object.entries(errors);
      if(array?.[0]?.[1]) message = array[0][1];
    }

    notify({
        title: title,
        text: message,
        type: "error"
    });
  }
}
