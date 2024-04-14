<x-layout>

    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold text-body-emphasis">ER Diagram</h1>

        <div class="col-lg-6 mx-auto mt-4">
            <p class="lead mb-1 text-start">
                Draw an E-R diagram of a system that provides communication between the users of 2
                companies.
                We have 2 types of companies in our system: Brokers and Vendors. The companies have users employed at
                them,
                one user can work in
                only one company and only one of the users in the company is the primary user.
                The conversations can be started either by a broker or by a vendor’s primary user. Each conversation
                must
                have at least one broker and
                one vendor, but the maximum number of users in one conversation is not limited. The conversation must
                have a
                topic, we need to know who
                started the conversation, between which companies, and when. Also, conversations can be archived by the
                primary user who started the
                conversation.
                Messages in the conversation can be textual, file uploads (the number of uploaded files per message is
                not
                limited), or can contain both
                (text and multiple files).
                Also, the users need to know when they have new unread messages.
            </p>

        </div>
    </div>
</x-layout>
