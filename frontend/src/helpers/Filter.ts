import { config } from "@/../env.d";

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        $filters: Record<string, Function>;
    }
}

export const filters = {
    imageFilter(value: string) {
        if(!value) return "/img/book.jpg";

        return config.imageUrl + value;
    }
}